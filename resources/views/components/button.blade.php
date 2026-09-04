@props([
    'href' => null,
    'variant' => 'primary', // primary | outline | ghost
])

@php
    $base = 'inline-flex items-center justify-center gap-2 rounded-full px-6 py-3 text-body-sm font-medium transition-colors duration-300 ease-out-expo';

    $variants = [
        'primary' => 'bg-lime-500 text-ink-950 hover:bg-lime-600',
        'outline' => 'border border-ink-600 text-paper hover:border-lime-500 hover:text-lime-500',
        'ghost' => 'text-paper hover:text-lime-500',
    ];

    $classes = $base . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => 'button', 'class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
