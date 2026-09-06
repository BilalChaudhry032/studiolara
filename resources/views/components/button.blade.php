@props([
    'href' => null,
    'variant' => 'primary', // primary | outline | ghost
])

@php
    $base = 'group relative isolate inline-flex items-center justify-center gap-2 overflow-hidden rounded-full px-6 py-3 text-body-sm font-medium transition-colors duration-300 ease-out-expo';

    $variants = [
        'primary' => 'bg-lime-500 text-ink-950 hover:bg-lime-600',
        'outline' => 'border border-ink-600 text-paper hover:border-lime-500 hover:text-lime-500',
        'ghost' => 'text-paper hover:text-lime-500',
    ];

    $classes = $base . ' ' . ($variants[$variant] ?? $variants['primary']);

    // Soft gradient glow that fades in behind the label on hover - confirmed
    // live on tapline.studio's outline CTA button (a `.second-button-hover`
    // sibling panel revealed via opacity), ported here with our lime accent
    // instead of their violet/red. Only the outline variant gets it: the
    // primary button's hover is already a full background-color invert and
    // doesn't need an added glow (matches tapline's own button-one, which
    // only carries this on its secondary/outline style).
    $glow = $variant === 'outline';
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if ($glow)
            <span aria-hidden="true" class="pointer-events-none absolute inset-0 opacity-0 transition-opacity duration-300 group-hover:opacity-100 [background:radial-gradient(120%_140%_at_50%_50%,theme(colors.lime.500/20%),transparent_70%)]"></span>
        @endif
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => 'button', 'class' => $classes]) }}>
        @if ($glow)
            <span aria-hidden="true" class="pointer-events-none absolute inset-0 opacity-0 transition-opacity duration-300 group-hover:opacity-100 [background:radial-gradient(120%_140%_at_50%_50%,theme(colors.lime.500/20%),transparent_70%)]"></span>
        @endif
        {{ $slot }}
    </button>
@endif
