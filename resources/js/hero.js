import gsap from 'gsap';
import { DrawSVGPlugin } from 'gsap/DrawSVGPlugin';
import { reducedMotion } from './motion';

gsap.registerPlugin(DrawSVGPlugin);

const TRUNK_DRAW = 0.8;

/**
 * The page's one authored moment: the service lines sweep in and merge at
 * the interchange, then the single line draws itself through its stations.
 * The drawing starts hidden (html.motion, see app.css) so it never flashes
 * fully drawn first; under reduced motion it simply appears complete.
 */
export function initHeroMap() {
    const map = [...document.querySelectorAll('[data-hero-map]')].find((el) => el.getClientRects().length);
    if (!map || reducedMotion()) return;

    const trunk = map.querySelector('[data-draw="trunk"]');
    const [interchange, ...stations] = map.querySelectorAll('[data-pop]');
    const pop = { scale: 0.4, opacity: 0, transformOrigin: '50% 50%', duration: 0.2, ease: 'power3.out' };

    const timeline = gsap.timeline()
        .set(map, { visibility: 'visible' })
        .addLabel('sweep');

    // Lines sweep in one after another; a casing (data-line shared with its
    // line) draws in step with the line it outlines.
    map.querySelectorAll('[data-draw="bundle"]').forEach((path) => {
        timeline.from(path, { drawSVG: 0, duration: 1, ease: 'power1.in' }, `sweep+=${path.dataset.line * 0.05}`);
    });

    timeline
        .addLabel('merge', '-=0.1')
        .from(interchange, pop, 'merge')
        .from(trunk, { drawSVG: 0, duration: TRUNK_DRAW, ease: 'none' }, 'merge');

    // Each later station appears the moment the line reaches it.
    const line = trunk.getBBox();
    stations.forEach((station) => {
        const box = station.getBBox();
        const along = (box.x + box.width / 2 - line.x) / line.width;
        timeline.from(station, pop, `merge+=${Math.max(0, along * TRUNK_DRAW - 0.05)}`);
    });
}
