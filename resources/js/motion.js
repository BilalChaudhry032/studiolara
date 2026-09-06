import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import Lenis from 'lenis';

gsap.registerPlugin(ScrollTrigger);

const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

/**
 * Smooth (inertia) scroll. Skipped entirely under prefers-reduced-motion —
 * this is exactly the kind of motion that spec is meant to suppress, and
 * native scroll is the correct fallback, not a slowed-down version of Lenis.
 */
function initSmoothScroll() {
    if (prefersReducedMotion) return;

    const lenis = new Lenis();

    lenis.on('scroll', ScrollTrigger.update);

    gsap.ticker.add((time) => {
        lenis.raf(time * 1000);
    });
    gsap.ticker.lagSmoothing(0);
}

/**
 * Scroll-triggered fade/slide-up entrance for anything marked data-reveal
 * (section headings, grid cards, process steps, FAQ items - see app.css for
 * the actual opacity/transform values). Under prefers-reduced-motion, skip
 * ScrollTrigger entirely and just reveal everything immediately - content
 * must never be permanently hidden for a user who can't trigger the reveal.
 */
function initScrollReveals() {
    const targets = gsap.utils.toArray('[data-reveal]');

    if (prefersReducedMotion) {
        targets.forEach((el) => el.classList.add('is-revealed'));
        return;
    }

    targets.forEach((el, index) => {
        ScrollTrigger.create({
            trigger: el,
            start: 'top 85%',
            once: true,
            onEnter: () => {
                // Small stagger for elements already grouped in a grid/row
                // (e.g. cards revealing left-to-right) without needing a
                // separate stagger timeline per section.
                const delay = Math.min(index % 4, 3) * 0.08;
                setTimeout(() => el.classList.add('is-revealed'), delay * 1000);
            },
        });
    });
}

export function initMotion() {
    initSmoothScroll();
    initScrollReveals();
}

/**
 * Odometer/slot-machine-style stat counter: digits scramble through random
 * values, then settle on the exact target as the scroll-triggered tween
 * approaches completion - not a plain linear count-up. Registered as an
 * Alpine component so the Blade side just declares target/suffix/duration.
 */
export function registerAlpineMotionComponents(Alpine) {
    Alpine.data('statCounter', (target, duration = 1.4) => ({
        display: 0,
        started: false,

        observe(el) {
            if (prefersReducedMotion) {
                this.display = target;
                return;
            }

            const observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting && !this.started) {
                            this.started = true;
                            this.run();
                        }
                    });
                },
                { threshold: 0.4 },
            );

            observer.observe(el);
        },

        run() {
            const proxy = { value: 0 };

            gsap.to(proxy, {
                value: target,
                duration,
                ease: 'power2.out',
                onUpdate: () => {
                    const progress = target === 0 ? 1 : proxy.value / target;
                    this.display = progress < 0.95
                        ? Math.floor(Math.random() * (target + 1))
                        : Math.round(proxy.value);
                },
                onComplete: () => {
                    this.display = target;
                },
            });
        },
    }));

    /**
     * Mouse-tracking 3D tilt, confirmed live on tapline.studio's value-prop
     * card row (rotateX/rotateY driven by cursor position inside the card,
     * springing back to 0 on mouseleave - a continuous "mouse move" trigger,
     * not a discrete hover state). Skipped under prefers-reduced-motion and
     * on coarse/touch pointers, where there's no cursor to track.
     */
    Alpine.data('tiltCard', (maxTilt = 8) => ({
        active: !prefersReducedMotion && window.matchMedia('(pointer: fine)').matches,
        quickX: null,
        quickY: null,

        init() {
            if (!this.active) return;
            this.quickX = gsap.quickTo(this.$el, 'rotationY', { duration: 0.4, ease: 'power3.out' });
            this.quickY = gsap.quickTo(this.$el, 'rotationX', { duration: 0.4, ease: 'power3.out' });
        },

        onMove(event) {
            if (!this.active) return;
            const rect = this.$el.getBoundingClientRect();
            const px = (event.clientX - rect.left) / rect.width - 0.5;
            const py = (event.clientY - rect.top) / rect.height - 0.5;
            this.quickX(px * maxTilt * 2);
            this.quickY(py * -maxTilt * 2);
        },

        onLeave() {
            if (!this.active) return;
            this.quickX(0);
            this.quickY(0);
        },
    }));
}
