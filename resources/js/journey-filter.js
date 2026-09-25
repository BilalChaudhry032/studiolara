import gsap from 'gsap';
import { Flip } from 'gsap/Flip';
import { reducedMotion } from './motion';

gsap.registerPlugin(Flip);

/**
 * Filters the journeys wall by service line. Posters that stay glide to
 * their new places and the others fade out (GSAP Flip), so the change reads
 * as the wall re-sorting rather than a jump. The chosen line is kept in the
 * URL (?line=u) so a filtered wall can be shared.
 */
export function registerJourneyFilter(Alpine) {
    Alpine.data('journeyFilter', (names) => ({
        line: new URLSearchParams(location.search).get('line') ?? '',

        init() {
            if (!(this.line in names)) this.line = '';
        },

        shows(lines) {
            return this.line === '' || lines.split(' ').includes(this.line);
        },

        get count() {
            return [...this.$root.querySelectorAll('[data-lines]')].filter((el) => this.shows(el.dataset.lines)).length;
        },

        get summary() {
            const n = this.count;
            const what = `${n} ${n === 1 ? 'journey' : 'journeys'}`;
            return this.line ? `${what} on the ${names[this.line]} line` : `All ${what}`;
        },

        choose(line) {
            const items = this.$root.querySelectorAll('[data-lines]');
            const state = reducedMotion() ? null : Flip.getState(items);

            this.line = line;
            const url = new URL(location.href);
            line ? url.searchParams.set('line', line) : url.searchParams.delete('line');
            history.replaceState(null, '', url);

            if (!state) return;
            this.$nextTick(() => {
                Flip.from(state, {
                    duration: 0.5,
                    ease: 'power2.inOut',
                    absolute: true,
                    onEnter: (els) => gsap.fromTo(els, { opacity: 0 }, { opacity: 1, duration: 0.3 }),
                    onLeave: (els) => gsap.to(els, { opacity: 0, duration: 0.2 }),
                });
            });
        },
    }));
}
