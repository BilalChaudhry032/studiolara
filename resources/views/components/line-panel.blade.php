@props([
    'service',
    'as' => 'h3',
])

{{-- One service drawn as its own line: the promise first, then its stations (use cases), who it suits, and its tools. --}}
<article {{ $attributes }}>
    <div class="flex items-center gap-4">
        <x-bullet :line="$service->line" size="lg" />
        <{{ $as }} class="text-display-md font-extrabold stretch-condensed">{{ $service->title }}</{{ $as }}>
    </div>

    <p class="mt-5 max-w-prose text-body-lg text-text-2">{{ \Illuminate\Support\Str::before($service->description, '. ') }}.</p>

    <div class="mt-8 grid gap-8 md:grid-cols-2">
        @if (! empty($service->use_cases))
            <div>
                <h4 class="text-body-sm font-semibold uppercase tracking-[0.06em] text-text-3">Stations on this line</h4>
                <x-route
                    class="mt-4"
                    :line="$service->line"
                    orientation="vertical"
                    :stations="array_map(fn ($useCase) => ['label' => $useCase], $service->use_cases)"
                />
            </div>
        @endif

        <div class="space-y-6">
            @if ($service->best_for)
                <div>
                    <h4 class="text-body-sm font-semibold uppercase tracking-[0.06em] text-text-3">Best for</h4>
                    <p class="mt-2 text-body-md">{{ $service->best_for }}</p>
                </div>
            @endif
            @if (! empty($service->tools_technologies))
                <div class="hidden md:block">
                    <h4 class="text-body-sm font-semibold uppercase tracking-[0.06em] text-text-3">Tools</h4>
                    <p class="mt-2 text-body-md text-text-2">{{ implode(' · ', $service->tools_technologies) }}</p>
                </div>
            @endif
            <x-button :href="route('services.show', $service->slug)" variant="ghost">Ride the {{ $service->title }} line</x-button>
        </div>
    </div>
</article>
