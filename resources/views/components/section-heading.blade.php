@props([
    'eyebrow' => null,
    'align' => 'left', // left | center
    'subtext' => null,
])

@php
    $alignClasses = $align === 'center' ? 'mx-auto text-center' : '';
@endphp

<div data-reveal {{ $attributes->merge(['class' => "max-w-3xl {$alignClasses}"]) }}>
    @if ($eyebrow)
        <p class="mb-4 text-eyebrow uppercase tracking-widest text-lime-500">{{ $eyebrow }}</p>
    @endif

    <h2 class="text-display-md font-semibold text-paper">
        {{ $slot }}
    </h2>

    @if ($subtext)
        <p class="mt-4 text-body-lg text-paper-dim">{{ $subtext }}</p>
    @endif
</div>
