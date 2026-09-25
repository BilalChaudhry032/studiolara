@php
    use Illuminate\Support\Str;

    // The description's first sentence is the promise; the rest says what's on board.
    $promise = Str::before($service->description, '. ') . '.';
    $onBoard = Str::contains($service->description, '. ') ? trim(Str::after($service->description, '. ')) : null;
    $stations = array_map(fn ($useCase) => ['label' => $useCase], $service->use_cases ?? []);
    $bar = ['u' => 'bg-line-u', 'w' => 'bg-line-w', 's' => 'bg-line-s', 'm' => 'bg-line-m', 'c' => 'bg-line-c'];
    $label = 'text-body-sm font-semibold uppercase tracking-[0.06em] text-text-3';
@endphp

<x-layout :title="$service->title" :description="$promise">
    <x-slot:head>
        <script type="application/ld+json">
            {!! json_encode([
                '@context' => 'https://schema.org',
                '@type' => 'Service',
                'name' => $service->title,
                'serviceType' => $service->title,
                'description' => $promise,
                'url' => url()->current(),
                'provider' => ['@type' => 'Organization', 'name' => config('app.name'), 'url' => url('/')],
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
        </script>
    </x-slot:head>

    {{-- HERO: the line itself. --}}
    <section class="pt-8 md:pt-12">
        <x-container>
            <nav aria-label="Breadcrumb">
                <ol class="flex flex-wrap items-center gap-2 text-body-sm font-semibold text-text-2">
                    <li><a href="{{ route('services.index') }}" class="inline-flex min-h-11 items-center underline decoration-text/40 decoration-2 underline-offset-[0.3em] hover:decoration-text">All lines</a></li>
                    <li aria-hidden="true">/</li>
                    <li aria-current="page">{{ $service->title }}</li>
                </ol>
            </nav>

            <div class="mt-6 flex flex-wrap items-center gap-x-6 gap-y-4">
                <x-bullet :line="$service->line" size="xl" />
                <h1 class="text-balance text-display-xl font-extrabold stretch-condensed">{{ $service->title }}</h1>
            </div>
            <p class="mt-6 max-w-[52ch] text-body-lg text-text-2">{{ $promise }}</p>
            <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center sm:gap-6">
                <x-button :href="route('contact')">Book a strategy call</x-button>
                <x-button :href="route('pricing')" variant="ghost" class="self-start sm:self-auto">See the fares</x-button>
            </div>

            @if ($stations)
                <h2 class="sr-only">Stations on this line</h2>
                <div class="mt-14 hidden md:block" data-line-in="x">
                    <x-route :line="$service->line" :stations="$stations" size="lg" />
                </div>
                <div class="mt-12 md:hidden" data-line-in="y">
                    <x-route :line="$service->line" :stations="$stations" orientation="vertical" />
                </div>
            @endif
        </x-container>
    </section>

    {{-- ON BOARD: what the line includes, who it's for, and the tools. --}}
    <section data-station="On board" class="py-16 md:py-24">
        <x-container>
            <x-sign :lines="[$service->line]">On board</x-sign>
            <div class="mt-10 grid gap-10 lg:grid-cols-12 lg:gap-12">
                <p class="max-w-prose text-heading-md font-semibold stretch-semi lg:col-span-6">{{ $onBoard ?? $service->description }}</p>
                @if ($service->best_for)
                    <div class="lg:col-span-3">
                        <h2 class="{{ $label }}">Who rides it</h2>
                        <p class="mt-3 text-body-lg">{{ $service->best_for }}</p>
                    </div>
                @endif
                @if (! empty($service->tools_technologies))
                    <div class="lg:col-span-3">
                        <h2 class="{{ $label }}">Tools</h2>
                        <ul class="mt-3 flex flex-wrap gap-2">
                            @foreach ($service->tools_technologies as $tool)
                                <li class="px-3 py-1.5 text-body-sm font-semibold ring-2 ring-inset ring-text">{{ $tool }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </x-container>
    </section>

    {{-- JOURNEYS ON THIS LINE --}}
    @if ($journeys->isNotEmpty())
        <section data-station="Journeys" class="py-16 md:py-24">
            <x-container>
                <x-sign :lines="[$service->line]">Journeys on this line</x-sign>
                @if ($journeys->contains('is_sample', true))
                    <p class="mt-6 max-w-prose text-body-lg text-text-2">Sample projects; real client work replaces them as it is cleared to publish.</p>
                @endif
                <x-poster-row class="mt-10" :studies="$journeys" :line-by-service="$lineByService" />
            </x-container>
        </section>
    @endif

    {{-- CHANGE HERE FOR: the other lines. --}}
    @if ($interchanges->isNotEmpty())
        <section data-station="Change here" class="py-16 md:py-24">
            <x-container>
                <x-sign :lines="$interchanges->pluck('line')->all()">Change here for</x-sign>
                <ul class="mt-8 grid gap-x-8 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($interchanges as $line)
                        <li>
                            <a href="{{ route('services.show', $line) }}" class="group relative flex min-h-16 items-center gap-4 py-4">
                                <x-bullet :line="$line->line" />
                                <span class="text-heading-md font-bold stretch-semi">{{ $line->title }}</span>
                                <x-arrow class="ml-auto shrink-0 text-heading-md transition-transform duration-150 ease-out-expo group-hover:translate-x-1" />
                                <span aria-hidden="true" class="absolute inset-x-0 bottom-0 h-1 origin-left scale-x-[0.15] transition-transform duration-300 ease-out-expo group-hover:scale-x-100 {{ $bar[$line->line] }}"></span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </x-container>
        </section>
    @endif

    <x-closing>Tell us where you are and where you want to go, and we'll plan the {{ $service->title }} route with you.</x-closing>
</x-layout>
