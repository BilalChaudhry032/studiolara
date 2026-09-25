@props([
    'before', // Spatie Media
    'after', // Spatie Media
    'label', // what is being compared, e.g. the case study title
])

@php
    $srcset = fn ($media) => $media->getUrl('medium') . ' 960w, ' . $media->getUrl('large') . ' 1920w';
@endphp

{{--
    Departure (before) and arrival (after), one over the other. A real range
    input drives the split, so it works by pointer, touch and keyboard, and
    screen readers get both images' descriptions.
--}}
<figure {{ $attributes->merge(['class' => 'relative']) }} x-data="{ split: 50 }">
    <div class="relative overflow-hidden border-4 border-text has-[input:focus-visible]:outline has-[input:focus-visible]:outline-[3px] has-[input:focus-visible]:outline-offset-2 has-[input:focus-visible]:outline-focus">
        <img src="{{ $after->getUrl('large') }}" srcset="{{ $srcset($after) }}" sizes="(min-width: 1440px) 1344px, 100vw" width="1920" height="1200" alt="After: {{ $label }}" class="block h-auto w-full">
        <img
            src="{{ $before->getUrl('large') }}"
            srcset="{{ $srcset($before) }}"
            sizes="(min-width: 1440px) 1344px, 100vw"
            width="1920"
            height="1200"
            alt="Before: {{ $label }}"
            class="absolute inset-0 h-full w-full object-cover"
            :style="`clip-path: inset(0 ${100 - split}% 0 0)`"
            style="clip-path: inset(0 50% 0 0)"
        >

        <span aria-hidden="true" class="pointer-events-none absolute left-3 top-3 bg-sign px-2.5 py-1 text-body-sm font-bold uppercase tracking-[0.06em] text-sign-ink stretch-condensed">Departure</span>
        <span aria-hidden="true" class="pointer-events-none absolute right-3 top-3 bg-sign px-2.5 py-1 text-body-sm font-bold uppercase tracking-[0.06em] text-sign-ink stretch-condensed">Arrival</span>

        {{-- The split line and its grip. --}}
        <span aria-hidden="true" class="pointer-events-none absolute inset-y-0 w-1.5 -translate-x-1/2 bg-text" :style="`left: ${split}%`" style="left: 50%">
            <span class="absolute left-1/2 top-1/2 grid h-12 w-12 -translate-x-1/2 -translate-y-1/2 place-items-center rounded-full border-4 border-text bg-ground text-text">
                <span class="flex text-body-sm"><x-arrow dir="left" /><x-arrow /></span>
            </span>
        </span>

        <input
            type="range"
            min="0"
            max="100"
            x-model.number="split"
            aria-label="Compare before and after. Lower values show more of the after state."
            :aria-valuetext="`${split}% before`"
            class="absolute inset-0 h-full w-full cursor-ew-resize appearance-none bg-transparent opacity-0"
        >
    </div>
    @isset($caption)
        <figcaption class="mt-3 text-body-sm text-text-2">{{ $caption }}</figcaption>
    @endisset
</figure>
