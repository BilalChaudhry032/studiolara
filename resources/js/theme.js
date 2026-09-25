import { reducedMotion } from './motion';

const ORDER = ['system', 'light', 'dark'];
const LABELS = { system: 'System', light: 'Light', dark: 'Dark' };

function readPreference() {
    try {
        return localStorage.getItem('theme') ?? 'system';
    } catch {
        return 'system';
    }
}

function savePreference(pref) {
    try {
        pref === 'system' ? localStorage.removeItem('theme') : localStorage.setItem('theme', pref);
    } catch {
        // Private mode or blocked storage: the choice lasts for this page only.
    }
}

/**
 * Shared theme state, so the header, mobile menu and footer toggles always
 * agree. `window.applyTheme` is defined by the inline script in the layout's
 * <head>, which also runs it before first paint to prevent a wrong-theme flash.
 */
export function registerTheme(Alpine) {
    Alpine.store('theme', {
        pref: readPreference(),

        get label() {
            return LABELS[this.pref];
        },

        cycle() {
            this.pref = ORDER[(ORDER.indexOf(this.pref) + 1) % ORDER.length];
            savePreference(this.pref);

            const apply = () => window.applyTheme(this.pref);
            document.startViewTransition && !reducedMotion() ? document.startViewTransition(apply) : apply();
        },
    });

    // While on System, follow the OS when it switches (e.g. at sunset).
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
        if (Alpine.store('theme').pref === 'system') window.applyTheme('system');
    });
}
