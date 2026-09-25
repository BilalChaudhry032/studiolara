{{-- Cycles System → Light → Dark. State lives in the shared Alpine store (resources/js/theme.js). --}}
<button
    type="button"
    x-data
    @click="$store.theme.cycle()"
    {{ $attributes->merge(['class' => 'inline-flex min-h-11 items-center gap-2 text-body-sm font-medium text-text-2 transition-colors duration-150 hover:text-text']) }}
>
    <x-heroicon-o-computer-desktop x-show="$store.theme.pref === 'system'" class="h-5 w-5" aria-hidden="true" />
    <x-heroicon-o-sun x-show="$store.theme.pref === 'light'" x-cloak class="h-5 w-5" aria-hidden="true" />
    <x-heroicon-o-moon x-show="$store.theme.pref === 'dark'" x-cloak class="h-5 w-5" aria-hidden="true" />
    <span><span class="sr-only">Theme: </span><span x-text="$store.theme.label">System</span></span>
</button>
