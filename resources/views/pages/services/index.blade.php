@php
    use Illuminate\Support\Str;

    $lineKeys = $services->pluck('line')->all();
    $dot = ['u' => 'bg-line-u', 'w' => 'bg-line-w', 's' => 'bg-line-s', 'm' => 'bg-line-m', 'c' => 'bg-line-c'];
    $processStations = array_map(fn ($stop) => ['label' => $stop['name'], 'note' => $stop['summary']], $process);
@endphp

<x-layout
    title="Services"
    description="Five lines, one team: UI/UX design, web development, SaaS product development, mobile apps and CMS development, run by one accountable team."
>
    {{-- HERO --}}
    <section class="pt-10 md:pt-16 lg:pt-20">
        <x-container class="grid gap-8 lg:grid-cols-12 lg:items-end">
            <div class="lg:col-span-8">
                <h1 class="text-balance text-display-xl font-extrabold stretch-condensed">Five lines. One team.</h1>
                <p class="mt-6 max-w-[52ch] text-body-lg text-text-2">
                    Product strategy, conversion-focused design, and scalable engineering, under one accountable team instead of handed off between vendors.
                </p>
            </div>
            <div class="lg:col-span-4 lg:justify-self-end">
                <x-button :href="route('contact')">Book a strategy call</x-button>
            </div>
        </x-container>
    </section>

    {{-- SYSTEM MAP: every service as a line with its stations. --}}
    <section data-station="System map" class="py-16 md:py-24">
        <x-container>
            <x-sign :lines="$lineKeys">System map</x-sign>
            <p class="mt-6 max-w-prose text-body-lg text-text-2">
                Each service is a line with its own stations. Pick the one that matches where you're going; every line runs on the same team.
            </p>

            <ol class="system-map mt-10 divide-y divide-rule border-y border-rule">
                @foreach ($services as $service)
                    <li class="group relative py-8 lg:grid lg:grid-cols-12 lg:items-center lg:gap-8 lg:py-10">
                        <div class="flex items-start justify-between gap-4 lg:col-span-4 lg:block">
                            <div>
                                <h3 class="flex items-center gap-4">
                                    <x-bullet :line="$service->line" size="lg" />
                                    {{-- The link covers the whole row. --}}
                                    <a href="{{ route('services.show', $service) }}" class="map-text text-heading-lg font-extrabold stretch-condensed transition-colors duration-300 after:absolute after:inset-0 after:content-['']">{{ $service->title }}</a>
                                </h3>
                                <p class="mt-3 max-w-[40ch] text-body-md text-text-2 lg:pl-16">{{ Str::before($service->description, '. ') }}.</p>
                            </div>
                            <x-arrow class="mt-3 shrink-0 text-heading-lg transition-transform duration-150 ease-out-expo group-hover:translate-x-1 lg:hidden" />
                        </div>

                        <div class="hidden lg:col-span-7 lg:block" data-line-in="x">
                            <x-route :line="$service->line" :stations="array_map(fn ($useCase) => ['label' => $useCase], $service->use_cases ?? [])" />
                        </div>

                        {{-- Phones and tablets: the same stations as a compact list. --}}
                        <ul class="mt-5 flex flex-wrap gap-x-5 gap-y-2 lg:hidden" aria-label="Stations on the {{ $service->title }} line">
                            @foreach ($service->use_cases ?? [] as $useCase)
                                <li class="flex items-center gap-2 text-body-sm font-semibold">
                                    <span aria-hidden="true" class="h-2.5 w-2.5 shrink-0 rounded-full ring-1 ring-text/30 {{ $dot[$service->line] }}"></span>{{ $useCase }}
                                </li>
                            @endforeach
                        </ul>

                        <x-arrow class="hidden justify-self-end text-heading-lg transition-transform duration-150 ease-out-expo group-hover:translate-x-1 lg:col-span-1 lg:block" />
                    </li>
                @endforeach
            </ol>
        </x-container>
    </section>

    {{-- HOW IT RUNS: the trunk every line shares. --}}
    <section data-station="How it runs" class="py-16 md:py-24">
        <x-container>
            <x-sign>How every line runs</x-sign>
            <p class="mt-6 max-w-prose text-body-lg text-text-2">
                Whichever line you ride, the project passes the same five stations with the same team from the first call to launch.
            </p>
            <div class="mt-12 hidden lg:block" data-line-in="x">
                <x-route :stations="$processStations" size="lg" />
            </div>
            <div class="mt-10 lg:hidden" data-line-in="y">
                <x-route :stations="$processStations" orientation="vertical" />
            </div>
        </x-container>
    </section>

    <x-closing />
</x-layout>
