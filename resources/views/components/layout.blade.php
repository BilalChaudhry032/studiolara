@props([
    'title' => null,
    'description' => null,
    'image' => null,
    'type' => 'website',
])

@php
    $fullTitle = $title ? "{$title} — " . config('app.name') : config('app.name');
    // No default OG image yet - no real brand/marketing image assets exist
    // (see the placeholder-images policy in PROJECT_PLAN_AND_PROGRESS.md).
    // Omit the tag entirely rather than point social scrapers at a 404.
    $ogImage = $image;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#FFFFFF" />

    {{--
        Runs before any CSS paints, so a visitor never sees the wrong theme
        flash. theme.js reuses applyTheme() when the toggle changes it.
        Preference: localStorage "light" | "dark", absent means System.
    --}}
    <script>
        window.applyTheme = function (pref) {
            var dark = pref === 'dark' || (pref !== 'light' && window.matchMedia('(prefers-color-scheme: dark)').matches);
            document.documentElement.dataset.theme = dark ? 'dark' : 'light';
            document.querySelector('meta[name="theme-color"]').content = dark ? '#0B0C0E' : '#FFFFFF';
        };
        try { window.applyTheme(localStorage.getItem('theme')); } catch (e) { window.applyTheme(null); }
        // html.motion lets animated elements start hidden (see app.css). If the
        // app never starts, drop it so nothing stays hidden.
        if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            document.documentElement.classList.add('motion');
            setTimeout(function () { if (!window.appReady) document.documentElement.classList.remove('motion'); }, 4000);
        }
    </script>
    <title>{{ $fullTitle }}</title>

    @if ($description)
        <meta name="description" content="{{ $description }}" />
    @endif

    <link rel="canonical" href="{{ url()->current() }}" />

    {{-- Open Graph --}}
    <meta property="og:site_name" content="{{ config('app.name') }}" />
    <meta property="og:type" content="{{ $type }}" />
    <meta property="og:title" content="{{ $fullTitle }}" />
    @if ($description)
        <meta property="og:description" content="{{ $description }}" />
    @endif
    <meta property="og:url" content="{{ url()->current() }}" />
    @if ($ogImage)
        <meta property="og:image" content="{{ $ogImage }}" />
    @endif

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="{{ $ogImage ? 'summary_large_image' : 'summary' }}" />
    <meta name="twitter:title" content="{{ $fullTitle }}" />
    @if ($description)
        <meta name="twitter:description" content="{{ $description }}" />
    @endif
    @if ($ogImage)
        <meta name="twitter:image" content="{{ $ogImage }}" />
    @endif

    {{-- Organization JSON-LD, site-wide --}}
    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => config('app.name'),
            'url' => url('/'),
        ], JSON_UNESCAPED_SLASHES) !!}
    </script>

    {{ $head ?? '' }}

    <link rel="preload" href="{{ Vite::asset('resources/fonts/archivo-latin.woff2') }}" as="font" type="font/woff2" crossorigin>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen flex-col">
    <a href="#main" class="sr-only z-[60] bg-action px-4 py-3 font-semibold text-action-ink focus:not-sr-only focus:fixed focus:left-4 focus:top-4">Skip to content</a>

    <x-nav />

    <main id="main" tabindex="-1" class="flex-1 focus:outline-none">
        {{ $slot }}
    </main>

    <x-footer />

    <x-here-bar />
</body>
</html>
