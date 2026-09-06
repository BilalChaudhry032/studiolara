@props([
    'padded' => true,
])

{{--
    Mouse-tracking 3D tilt (see motion.js `tiltCard`), applied to every card
    site-wide - confirmed live on tapline.studio's value-prop cards and
    ported here. `perspective` lives on <body> (layout.blade.php) so cards
    don't need a wrapper for it. Skips itself under prefers-reduced-motion
    and on touch/coarse pointers (see tiltCard.active).
--}}
<div
    data-reveal
    x-data="tiltCard()"
    @mousemove="onMove"
    @mouseleave="onLeave"
    {{ $attributes->merge(['class' => 'rounded-2xl border border-ink-700 bg-ink-900 [transform-style:preserve-3d] will-change-transform ' . ($padded ? 'p-6 md:p-8' : '')]) }}
>
    {{ $slot }}
</div>
