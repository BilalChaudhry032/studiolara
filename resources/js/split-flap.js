import gsap from 'gsap';
import { reducedMotion } from './motion';

const GLYPHS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789$+';

/**
 * Solari departure-board text. The tiles flip through a few random glyphs
 * and settle on the real text: once when the board first comes into view,
 * and again whenever set() gives it a new value. Screen readers get the
 * plain text from the sibling live region, never the flipping tiles.
 */
export function registerSplitFlap(Alpine) {
    Alpine.data('splitFlap', (text, length = null) => {
        // Kept out of Alpine's reactive state: a Proxy-wrapped GSAP timeline
        // never fires its call() callbacks.
        let timeline = null;

        return {
            text,
            length: length ?? text.length,

            init() {
                if (reducedMotion()) return;

                this.paint('');
                const observer = new IntersectionObserver(([entry]) => {
                    if (!entry.isIntersecting) return;
                    observer.disconnect();
                    this.flip(this.text);
                }, { threshold: 0.5 });
                observer.observe(this.$el);
            },

            set(value) {
                if (value === this.text) return;
                this.text = value;
                reducedMotion() ? this.paint(value) : this.flip(value);
            },

            tiles() {
                const board = this.$refs.tiles;
                while (board.children.length < this.length) {
                    const tile = document.createElement('span');
                    tile.className = 'flap';
                    board.append(tile);
                }
                return [...board.children];
            },

            paint(value) {
                const chars = value.toUpperCase().padEnd(this.length);
                this.tiles().forEach((tile, i) => { tile.textContent = chars[i]; });
            },

            flip(value) {
                timeline?.kill();
                timeline = gsap.timeline();
                const chars = value.toUpperCase().padEnd(this.length);

                this.tiles().forEach((tile, i) => {
                    const start = i * 0.018;
                    const spins = chars[i] === ' ' ? 1 : 3 + (i % 3);

                    for (let step = 0; step < spins; step++) {
                        const glyph = GLYPHS[Math.floor(Math.random() * GLYPHS.length)];
                        timeline.call(() => this.show(tile, glyph), null, start + step * 0.05);
                    }
                    timeline.call(() => this.show(tile, chars[i]), null, start + spins * 0.05);
                });
            },

            show(tile, glyph) {
                tile.textContent = glyph;
                tile.animate([{ transform: 'scaleY(0.2)' }, { transform: 'scaleY(1)' }], { duration: 60, easing: 'ease-out' });
            },
        };
    });
}
