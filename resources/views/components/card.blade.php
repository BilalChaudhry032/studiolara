@props([
    'padded' => true,
])

<div data-reveal {{ $attributes->merge(['class' => 'rounded-2xl border border-ink-700 bg-ink-900 ' . ($padded ? 'p-6 md:p-8' : '')]) }}>
    {{ $slot }}
</div>
