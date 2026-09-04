@props([
    'label' => 'Image',
    'ratio' => 'aspect-[4/3]', // any Tailwind aspect-ratio utility
])

{{--
    Neutral stand-in for real photography/screenshots (hero visuals, team
    photos, client logos, case-study screenshots) until real assets are
    provided — see PROJECT_PLAN_AND_PROGRESS.md. Swap for a real <img> /
    Spatie Media Library conversion once assets exist; no other markup
    should need to change since callers just pass label + ratio.
--}}
<div {{ $attributes->merge(['class' => "{$ratio} flex items-center justify-center overflow-hidden rounded-2xl border border-ink-700 bg-gradient-to-br from-ink-800 to-ink-900"]) }}>
    <span class="px-4 text-center text-body-sm text-muted">{{ $label }}</span>
</div>
