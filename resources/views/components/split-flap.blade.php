@props([
    'text',
    'length' => null, // tile count; set it when the text will change so the board keeps its width
    'watch' => null, // optional Alpine expression from the parent scope; the board flips whenever it changes
    'label' => null, // what screen readers hear instead of the board text, e.g. "Journey time 3 – 8 weeks"
])

<span
    x-data="splitFlap(@js($text), @js($length))"
    @if ($watch) x-effect="set({{ $watch }})" @endif
    {{ $attributes->merge(['class' => 'inline-flex']) }}
>
    {{-- Tiles are rendered here so the text reads without JavaScript; split-flap.js animates them. --}}
    <span x-ref="tiles" aria-hidden="true" class="inline-flex gap-[2px]">@foreach (array_pad(mb_str_split(mb_strtoupper($text)), $length ?? mb_strlen($text), ' ') as $char)<span class="flap">{{ $char }}</span>@endforeach</span>
    @if ($label)
        <span class="sr-only">{{ $label }}</span>
    @else
        <span class="sr-only" aria-live="polite" x-text="text">{{ $text }}</span>
    @endif
</span>
