import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { reducedMotion } from './motion';

/**
 * The page as a journey. Everything is keyed to the middle of the viewport:
 *
 * - [data-stop]: a station marker. It fills (is-passed) once the middle of
 *   the screen has passed it, and stays filled to the bottom of the page.
 * - [data-ride]: a line with a [data-track], and optionally a [data-fill]
 *   and a [data-train]. The train sits at the middle of the screen, held
 *   between the ride's first and last stop, so it is always where the
 *   visitor is reading. The track ends at the last stop.
 *   data-ride="from-top" starts the track at the top of the ride instead
 *   of the first stop, so it can continue a line drawn above it.
 * - [data-station="Name"]: a section. While it holds the middle of the
 *   screen, a "station" event carries its name (null once none does).
 * - [data-line-in="x|y"]: a line that reveals along its direction the first
 *   time it scrolls into view.
 */
export function initJourney() {
    document.querySelectorAll('[data-stop]').forEach((stop) => {
        // Progress, not isActive: at the very bottom of the page the scroll
        // position equals `end`, which ScrollTrigger counts as inactive.
        const mark = (self) => stop.classList.toggle('is-passed', self.progress > 0);
        ScrollTrigger.create({ trigger: stop, start: 'center center', end: 'max', onToggle: mark, onRefresh: mark });
    });

    let current = null;
    document.querySelectorAll('[data-station]').forEach((section) => {
        ScrollTrigger.create({
            trigger: section,
            start: 'top center',
            end: 'bottom center',
            onToggle: (self) => {
                if (self.isActive) current = section.dataset.station;
                else if (current === section.dataset.station) current = null;
                window.dispatchEvent(new CustomEvent('station', { detail: current }));
            },
        });
    });

    document.querySelectorAll('[data-ride]').forEach(ride);

    // A line arriving: revealed along its own direction the first time it scrolls into view.
    if (!reducedMotion()) {
        document.querySelectorAll('[data-line-in]').forEach((line) => {
            gsap.fromTo(line, { clipPath: line.dataset.lineIn === 'y' ? 'inset(0% 0% 100% 0%)' : 'inset(0% 100% 0% 0%)' }, {
                clipPath: 'inset(0% 0% 0% 0%)',
                duration: 0.9,
                ease: 'power2.inOut',
                scrollTrigger: { trigger: line, start: 'top 85%', once: true },
            });
        });
    }
}

function ride(root) {
    const track = root.querySelector(':scope > [data-track]');
    const fill = root.querySelector(':scope > [data-fill]');
    const train = root.querySelector(':scope > [data-train]');
    const stops = [...root.querySelectorAll('[data-stop]')];
    if (!track || !stops.length) return;

    const fromTop = root.dataset.ride === 'from-top';
    let first = 0;
    let last = 0;

    // Stop centres relative to the ride. Hidden stops (display: none at
    // this breakpoint) have no box and are skipped.
    const measure = () => {
        const origin = root.getBoundingClientRect().top;
        const ys = stops
            .filter((stop) => stop.getClientRects().length)
            .map((stop) => {
                const box = stop.getBoundingClientRect();
                return box.top + box.height / 2 - origin;
            });
        if (!ys.length) return;

        [first, last] = [ys[0], ys[ys.length - 1]];
        const top = fromTop ? 0 : first;
        gsap.set(track, { top, height: last - top });
        if (fill) gsap.set(fill, { top: first });
    };

    measure();

    if (reducedMotion() || !train) {
        ScrollTrigger.addEventListener('refresh', measure);
        return;
    }

    const placeTrain = gsap.quickSetter(train, 'y', 'px');
    const sizeFill = fill ? gsap.quickSetter(fill, 'height', 'px') : () => {};

    ScrollTrigger.create({
        trigger: root,
        start: 'top bottom',
        end: 'bottom top',
        onRefresh: measure,
        onUpdate: () => {
            const middle = window.innerHeight / 2 - root.getBoundingClientRect().top;
            const y = gsap.utils.clamp(first, last, middle);
            placeTrain(y);
            sizeFill(y - first);
        },
    });
}
