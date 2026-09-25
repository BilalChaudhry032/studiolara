@props([
    'as' => 'h2',
    'size' => 'lg', // md | lg | xl
    'lines' => [], // route bullets shown before the title
    'arrow' => null, // arrow direction, e.g. 'right'
])

@php
    [$type, $pad, $bullet] = [
        'md' => ['text-heading-md', 'px-4 pb-3 pt-2.5', 'sm'],
        'lg' => ['text-display-md', 'px-5 pb-4 pt-3 md:px-6', 'md'],
        'xl' => ['text-display-lg', 'px-5 pb-5 pt-4 md:px-8', 'lg'],
    ][$size];
@endphp

{{--
    Sign band, after the NYCTA standard: a solid band, a thin rule across
    its top, and heavy condensed type. Used as a heading, never as a label
    above one.
--}}
<div {{ $attributes->merge(['class' => 'bg-sign pt-1.5 text-sign-ink']) }}>
    <div class="flex flex-wrap items-center gap-x-3 gap-y-2 border-t-2 border-sign-ink {{ $pad }}">
        @foreach ($lines as $line)
            <x-bullet :line="$line" :size="$bullet" />
        @endforeach

        <{{ $as }} class="{{ $type }} min-w-0 flex-[1_1_12rem] font-bold stretch-condensed">{{ $slot }}</{{ $as }}>

        @if ($arrow)
            <x-arrow :dir="$arrow" class="{{ $type }}" />
        @endif
    </div>
</div>
