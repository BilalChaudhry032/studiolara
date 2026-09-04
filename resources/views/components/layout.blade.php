@props([
    'title' => null,
    'description' => null,
])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ? "{$title} — " . config('app.name') : config('app.name') }}</title>

    @if ($description)
        <meta name="description" content="{{ $description }}" />
    @endif

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
