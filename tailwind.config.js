import defaultTheme from 'tailwindcss/defaultTheme';
import typography from '@tailwindcss/typography';
import plugin from 'tailwindcss/plugin';

// "One Line" design tokens (see REDESIGN_PLAN.md §2.1). Each value is an
// RGB channel triplet so Tailwind opacity modifiers (bg-ground/80) work.
// Contrast was checked for both themes: text-3 is at least 4.5:1 on ground
// and panel, and every line fill is at least 4.5:1 against its letter
// colour. The exception is line-m (yellow) as a stroke on day white, which
// the line component draws with an ink casing, as real transit maps do.
const day = {
    '--ground': '255 255 255',
    '--panel': '241 242 244',
    '--rule': '213 216 221',
    '--text': '17 18 20',
    '--text-2': '74 78 85',
    '--text-3': '101 106 114',
    '--sign': '17 18 20',
    '--sign-ink': '255 255 255',
    '--action': '17 18 20',
    '--action-ink': '255 255 255',
    '--focus': '31 79 216',
    '--flap': '17 18 20',
    '--line-u': '212 47 30',
    '--line-w': '31 79 216',
    '--line-s': '10 125 62',
    '--line-m': '247 198 0',
    '--line-c': '139 53 191',
    '--line-ink': '255 255 255',
    '--line-m-ink': '17 18 20',
    'color-scheme': 'light',
};

// Night service: signs become lit panels, the primary action inverts, and
// line colours lift so they hold 3:1 as strokes on near-black.
const night = {
    '--ground': '11 12 14',
    '--panel': '23 24 27',
    '--rule': '44 46 51',
    '--text': '244 244 242',
    '--text-2': '180 183 189',
    '--text-3': '142 146 154',
    '--sign': '28 29 33',
    '--sign-ink': '244 244 242',
    '--action': '244 244 242',
    '--action-ink': '11 12 14',
    '--focus': '107 148 255',
    '--flap': '44 46 51',
    '--line-u': '255 94 74',
    '--line-w': '107 148 255',
    '--line-s': '47 196 110',
    '--line-m': '255 210 31',
    '--line-c': '192 124 255',
    '--line-ink': '11 12 14',
    '--line-m-ink': '11 12 14',
    'color-scheme': 'dark',
};

const token = (name) => `rgb(var(--${name}) / <alpha-value>)`;

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: ['selector', '[data-theme="dark"]'],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Archivo', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                ground: token('ground'),
                panel: token('panel'),
                rule: token('rule'),
                text: {
                    DEFAULT: token('text'),
                    2: token('text-2'),
                    3: token('text-3'),
                },
                sign: { DEFAULT: token('sign'), ink: token('sign-ink') },
                action: { DEFAULT: token('action'), ink: token('action-ink') },
                focus: token('focus'),
                line: {
                    u: token('line-u'),
                    w: token('line-w'),
                    s: token('line-s'),
                    m: token('line-m'),
                    c: token('line-c'),
                    ink: token('line-ink'),
                    'm-ink': token('line-m-ink'),
                },

                // Legacy aliases so pages not yet rebuilt still follow the
                // theme. Delete each one once R2–R5 stop using it.
                ink: {
                    950: token('ground'),
                    900: token('panel'),
                    800: token('rule'),
                    700: token('rule'),
                    600: token('text-3'),
                },
                paper: { DEFAULT: token('text'), dim: token('text-2') },
                muted: { DEFAULT: token('text-3') },
                lime: {
                    400: token('action'),
                    500: token('action'),
                    600: token('action'),
                    700: token('action'),
                },
            },
            // Fluid scale for a 360px to 1920px range. Display tops out at
            // 6rem, with tracking no tighter than -0.04em.
            fontSize: {
                'display-xl': ['clamp(2.75rem, 1.8rem + 4.2vw, 6rem)', { lineHeight: '0.96', letterSpacing: '-0.035em' }],
                'display-lg': ['clamp(2.25rem, 1.55rem + 3vw, 4.75rem)', { lineHeight: '1', letterSpacing: '-0.03em' }],
                'display-md': ['clamp(1.875rem, 1.4rem + 2vw, 3.25rem)', { lineHeight: '1.04', letterSpacing: '-0.025em' }],
                'heading-lg': ['clamp(1.5rem, 1.3rem + 0.9vw, 2.25rem)', { lineHeight: '1.12', letterSpacing: '-0.015em' }],
                'heading-md': ['clamp(1.25rem, 1.15rem + 0.45vw, 1.5rem)', { lineHeight: '1.22', letterSpacing: '-0.01em' }],
                'body-lg': ['clamp(1.0625rem, 1rem + 0.3vw, 1.25rem)', { lineHeight: '1.55' }],
                'body-md': ['1rem', { lineHeight: '1.6' }],
                'body-sm': ['0.875rem', { lineHeight: '1.5' }],
                eyebrow: ['0.8125rem', { lineHeight: '1', letterSpacing: '0.08em' }],
            },
            maxWidth: {
                container: '90rem',
            },
            transitionTimingFunction: {
                'out-expo': 'cubic-bezier(0.16, 1, 0.3, 1)',
            },
        },
    },
    plugins: [
        typography,
        plugin(({ addBase, addUtilities }) => {
            // Day is the default. The head script in layout.blade.php sets
            // data-theme before first paint; the media query covers no-JS.
            addBase({
                ':root': day,
                '[data-theme="dark"]': night,
                '@media (prefers-color-scheme: dark)': { ':root:not([data-theme])': night },
            });

            // Archivo's width axis: signage sets condensed, body stays normal.
            addUtilities({
                '.stretch-condensed': { 'font-stretch': '75%' },
                '.stretch-semi': { 'font-stretch': '87.5%' },
                '.stretch-normal': { 'font-stretch': '100%' },
            });
        }),
    ],
};
