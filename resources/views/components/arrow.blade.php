@props([
    'dir' => 'right', // right | left | up | down | up-right | down-right
])

@php
    $rotate = [
        'right' => '',
        'left' => 'rotate-180',
        'up' => '-rotate-90',
        'down' => 'rotate-90',
        'up-right' => '-rotate-45',
        'down-right' => 'rotate-45',
    ][$dir];
@endphp

{{-- The signage arrow: a straight shaft with a solid head, as on transit wayfinding signs. --}}
<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" {{ $attributes->merge(['class' => "h-[1em] w-[1em] shrink-0 {$rotate}"]) }}>
    <path d="M2.5 10.25h10.75V4.5L21.5 12l-8.25 7.5v-5.75H2.5z" />
</svg>
