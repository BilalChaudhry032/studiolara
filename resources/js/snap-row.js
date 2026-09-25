import { reducedMotion } from './motion';

/**
 * A swipeable row with scroll snapping (x-ref="row"). Tracks which slide is
 * showing so previous/next buttons and a pager can follow it and move it,
 * which keeps the row usable without a touchscreen.
 */
export function registerSnapRow(Alpine) {
    Alpine.data('snapRow', () => ({
        index: 0,
        count: 0,

        init() {
            const row = this.$refs.row;
            this.count = row.children.length;
            row.addEventListener('scroll', () => {
                const start = row.children[0].offsetLeft;
                const distances = [...row.children].map((slide) => Math.abs(slide.offsetLeft - start - row.scrollLeft));
                this.index = distances.indexOf(Math.min(...distances));
            }, { passive: true });
        },

        go(i) {
            const row = this.$refs.row;
            const target = Math.max(0, Math.min(this.count - 1, i));
            row.scrollTo({
                left: row.children[target].offsetLeft - row.children[0].offsetLeft,
                behavior: reducedMotion() ? 'auto' : 'smooth',
            });
        },
    }));
}
