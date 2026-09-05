@props([
    'target',
    'suffix' => '',
    'label',
    'duration' => 1.4,
])

<div>
    <p
        x-data="statCounter({{ (int) $target }}, {{ (float) $duration }})"
        x-init="observe($el)"
        class="text-display-md font-semibold text-lime-500 tabular-nums"
    ><span x-text="display">0</span>{{ $suffix }}</p>
    <p class="mt-2 text-body-sm text-paper-dim">{{ $label }}</p>
</div>
