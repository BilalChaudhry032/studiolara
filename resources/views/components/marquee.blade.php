@props([
    'speed' => 30, // seconds for one full loop — lower is faster
    'direction' => 'left', // left | right
    'pauseOnHover' => true,
])

{{--
    Reusable infinite marquee: duplicates the slot content once so the loop
    is seamless, drives it with a pure-CSS animation (cheap, no JS per-frame
    cost), and respects prefers-reduced-motion globally via the
    animation-duration override in resources/css/app.css — no extra work
    needed here. Used for client logos, testimonials, and service-tag
    divider strips across the site.
--}}
<div {{ $attributes->merge(['class' => 'group/marquee overflow-hidden']) }}>
    <div
        class="flex w-max {{ $direction === 'right' ? 'animate-[marquee-right_var(--marquee-duration)_linear_infinite]' : 'animate-[marquee-left_var(--marquee-duration)_linear_infinite]' }} {{ $pauseOnHover ? 'group-hover/marquee:[animation-play-state:paused]' : '' }}"
        style="--marquee-duration: {{ $speed }}s"
    >
        <div class="flex shrink-0 items-center gap-8 pr-8">{{ $slot }}</div>
        <div class="flex shrink-0 items-center gap-8 pr-8" aria-hidden="true">{{ $slot }}</div>
    </div>
</div>
