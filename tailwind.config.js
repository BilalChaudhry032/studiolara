import defaultTheme from 'tailwindcss/defaultTheme';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
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
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Near-black base + panel/card surfaces on top of it.
                ink: {
                    950: '#0B0B0C',
                    900: '#131316',
                    800: '#1B1B1F',
                    700: '#26262B',
                    600: '#38383F',
                },
                // Warm off-white text + a muted grey for secondary copy.
                paper: {
                    DEFAULT: '#F5F5F0',
                    dim: '#C9C9C2',
                },
                muted: {
                    DEFAULT: '#8A8A93',
                },
                // Brand accent: electric lime. Confirmed with the user 2026-09-04,
                // treat the exact hex as a starting point until checked for
                // WCAG AA contrast in both text-on-lime and lime-on-black uses.
                lime: {
                    DEFAULT: '#D7FF3F',
                    400: '#E4FF6B',
                    500: '#D7FF3F',
                    600: '#C2EB2B',
                    700: '#A8CC1F',
                },
            },
            // Fluid type scale via clamp() instead of fixed breakpoint jumps.
            // min/preferred/max chosen for a 375px -> 1920px viewport range.
            fontSize: {
                'display-xl': ['clamp(2.75rem, 1.9rem + 3.6vw, 6.5rem)', { lineHeight: '1.02', letterSpacing: '-0.02em' }],
                'display-lg': ['clamp(2.25rem, 1.6rem + 2.8vw, 5rem)', { lineHeight: '1.04', letterSpacing: '-0.02em' }],
                'display-md': ['clamp(1.875rem, 1.45rem + 1.9vw, 3.25rem)', { lineHeight: '1.08', letterSpacing: '-0.015em' }],
                'heading-lg': ['clamp(1.5rem, 1.3rem + 0.9vw, 2.25rem)', { lineHeight: '1.15', letterSpacing: '-0.01em' }],
                'heading-md': ['clamp(1.25rem, 1.15rem + 0.45vw, 1.5rem)', { lineHeight: '1.25' }],
                'body-lg': ['clamp(1.0625rem, 1rem + 0.3vw, 1.25rem)', { lineHeight: '1.6' }],
                'body-md': ['1rem', { lineHeight: '1.65' }],
                'body-sm': ['0.875rem', { lineHeight: '1.5' }],
                eyebrow: ['0.8125rem', { lineHeight: '1', letterSpacing: '0.14em' }],
            },
            maxWidth: {
                container: '90rem',
            },
            transitionTimingFunction: {
                'out-expo': 'cubic-bezier(0.16, 1, 0.3, 1)',
            },
        },
    },
    plugins: [typography],
};
