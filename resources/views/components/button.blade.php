@props([
    'href' => null,
    'variant' => 'primary', // primary | outline | ghost | on-sign (outline for use on sign bands)
    'arrow' => true,
    'size' => 'md', // sm | md
])

@php
    $base = 'group inline-flex min-h-11 items-center justify-center gap-3 font-semibold stretch-semi transition-colors duration-150 active:translate-y-px';
    $pad = $variant === 'ghost' ? 'py-2' : ($size === 'sm' ? 'px-4 py-2' : 'px-5 py-3');

    // Primary is a sign: solid, square, with an arrow. On hover it inverts
    // and keeps its shape through the inset ring.
    $variants = [
        'primary' => 'bg-action text-action-ink ring-2 ring-inset ring-action hover:bg-ground hover:text-text',
        'outline' => 'text-text ring-2 ring-inset ring-text hover:bg-action hover:text-action-ink',
        'ghost' => 'text-text underline decoration-text/40 decoration-2 underline-offset-[0.35em] hover:decoration-text',
        'on-sign' => 'text-sign-ink ring-2 ring-inset ring-sign-ink hover:bg-sign-ink hover:text-sign',
    ];

    $classes = implode(' ', [$base, $pad, $size === 'sm' ? 'text-body-sm' : 'text-body-md', $variants[$variant] ?? $variants['primary']]);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        <span>{{ $slot }}</span>
        @if ($arrow)
            <x-arrow class="transition-transform duration-150 ease-out-expo group-hover:translate-x-1" />
        @endif
    </a>
@else
    <button {{ $attributes->merge(['type' => 'button', 'class' => $classes . ' disabled:pointer-events-none disabled:opacity-40']) }}>
        <span>{{ $slot }}</span>
        @if ($arrow)
            <x-arrow class="transition-transform duration-150 ease-out-expo group-hover:translate-x-1" />
        @endif
    </button>
@endif
