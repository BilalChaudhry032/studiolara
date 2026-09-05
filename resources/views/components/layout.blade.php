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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen flex-col bg-ink-950 text-paper">
    <x-nav />

    <main class="flex-1">
        {{ $slot }}
    </main>

    <x-footer />
</body>
</html>
