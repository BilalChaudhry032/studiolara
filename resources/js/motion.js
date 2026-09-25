import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import Lenis from 'lenis';

gsap.registerPlugin(ScrollTrigger);

const reducedQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
const finePointer = window.matchMedia('(pointer: fine)');

/**
 * Every effect checks this before it moves anything. It is read live, so
 * switching the OS setting mid-visit takes effect without a reload.
 */
export const reducedMotion = () => reducedQuery.matches;

/**
 * One clock for the whole site. GSAP's ticker drives Lenis and every tween,
 * so scroll-linked effects (the train on the spine, station arrivals) never
 * drift apart from the scroll position they describe.
 */
export const clock = gsap.ticker;

let lenis = null;
const lenisFrame = (time) => lenis?.raf(time * 1000);

/**
 * Inertia scroll only for a mouse or trackpad, and only when motion is
 * allowed. Touch devices keep native scrolling, which is already smooth and
 * which people expect to feel exactly like every other site.
 */
function syncSmoothScroll() {
    const wanted = !reducedMotion() && finePointer.matches;

    if (wanted && !lenis) {
        lenis = new Lenis();
        lenis.on('scroll', ScrollTrigger.update);
        clock.add(lenisFrame);
    } else if (!wanted && lenis) {
        clock.remove(lenisFrame);
        lenis.destroy();
        lenis = null;
    }
}

/**
 * Walkthrough videos (x-video): play while at least half in view, pause
 * when scrolled away or when the tab is hidden. Nothing starts on its own
 * under reduced motion, and a visitor's own pause (data-user-paused) holds.
 */
function initVideos() {
    const videos = [...document.querySelectorAll('video[data-autoplay]')];
    if (!videos.length) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(({ target, isIntersecting }) => {
            if (isIntersecting && !reducedMotion() && !target.dataset.userPaused && !document.hidden) {
                target.play().catch(() => {});
            } else if (!isIntersecting) {
                target.pause();
            }
        });
    }, { threshold: 0.5 });

    videos.forEach((video) => observer.observe(video));
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) videos.forEach((video) => video.pause());
    });
}

export function initMotion() {
    clock.lagSmoothing(0);
    syncSmoothScroll();
    reducedQuery.addEventListener('change', syncSmoothScroll);
    initVideos();
}
