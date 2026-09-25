@props([
    'plans',
])

{{-- The three plans as a departure board: where each one takes you, how long the journey is, and the fare it starts at. --}}
<div {{ $attributes->merge(['class' => 'bg-panel p-5 md:p-6']) }}>
    <div class="flex items-baseline justify-between gap-4 border-b border-rule pb-3">
        <h2 class="text-body-sm font-semibold uppercase tracking-[0.06em] text-text-3">Departures</h2>
        <a href="{{ route('pricing') }}" class="group inline-flex min-h-11 items-center gap-2 text-body-sm font-semibold underline decoration-transparent decoration-2 underline-offset-[0.3em] hover:decoration-current">
            All fares
            <x-arrow class="transition-transform duration-150 ease-out-expo group-hover:translate-x-1" />
        </a>
    </div>

    <ol class="divide-y divide-rule">
        @foreach ($plans as $plan)
            <li class="py-4 last:pb-0">
                <p class="text-base sm:text-[1.125rem]">
                    <x-split-flap :text="$plan->tagline" :length="19" :label="$plan->name . ': ' . $plan->tagline" />
                </p>
                <p class="mt-2 flex flex-wrap items-center gap-x-4 gap-y-2 text-[0.75rem] sm:text-[0.875rem]">
                    <span class="inline-flex items-center gap-2">
                        <span aria-hidden="true" class="font-sans text-body-sm font-semibold text-text-2">Journey</span>
                        <x-split-flap :text="$plan->short_timeline" :length="9" :label="'Journey time ' . $plan->timeline" />
                    </span>
                    @if ($plan->fare_from)
                        <span class="inline-flex items-center gap-2">
                            <span aria-hidden="true" class="font-sans text-body-sm font-semibold text-text-2">From</span>
                            <x-split-flap :text="$plan->fare_from" :length="7" :label="'Fares from ' . $plan->fare_from" />
                        </span>
                    @endif
                </p>
            </li>
        @endforeach
    </ol>
</div>
