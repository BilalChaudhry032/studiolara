@php
    $lineKeys = $services->pluck('line')->all();
    $lineFill = ['u' => 'bg-line-u', 'w' => 'bg-line-w', 's' => 'bg-line-s', 'm' => 'bg-line-m', 'c' => 'bg-line-c'];

    // Spine geometry (lg+): the line runs 24px left of the container's content edge.
    $sectionStop = 'absolute left-[-37px] top-1/2 hidden h-[26px] w-[26px] -translate-y-1/2 rounded-full border-4 border-text bg-ground transition-colors duration-150 [&.is-passed]:bg-text lg:block';
@endphp

<x-layout
    title="Home"
    description="One team, one line: strategy, product design and engineering for startups and growing companies, from idea to launch."
>
    {{-- HERO: what Studio is, who it's for, what it costs, and the next step, in one screen. --}}
    <section class="relative overflow-hidden pt-10 md:pt-16 lg:pt-20">
        <x-container>
            <div class="grid gap-10 lg:grid-cols-12 lg:items-end lg:gap-12">
                <div class="lg:col-span-7">
                    <h1 class="text-balance text-display-xl font-extrabold stretch-condensed">One team. One line. From idea to launch.</h1>
                    <p class="mt-6 max-w-[46ch] text-body-lg text-text-2">
                        Strategy, product design and engineering for startups and growing companies, run by one accountable team instead of a chain of vendors.
                    </p>
                    <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center sm:gap-6">
                        <x-button :href="route('contact')">Book a strategy call</x-button>
                        <x-button :href="route('work.index')" variant="ghost" class="self-start sm:self-auto">See the work</x-button>
                    </div>
                </div>

                <x-departures :plans="$plans" class="lg:col-span-5" />
            </div>

            <x-hero-map class="mt-12 md:mt-16" :lines="$lineKeys" :stations="array_column($process, 'name')" />
        </x-container>
    </section>

    {{-- From here the page is one ride. On lg+ the spine runs down the left gutter, 24px left of the content edge, with a train at the reader's position. --}}
    <div data-ride class="relative">
        <span data-track aria-hidden="true" class="absolute left-[calc(max(0px,(100%_-_90rem)/2)_+_21px)] top-0 hidden w-1.5 bg-rule lg:block"></span>
        <span data-fill aria-hidden="true" class="absolute left-[calc(max(0px,(100%_-_90rem)/2)_+_21px)] top-0 hidden h-0 w-1.5 bg-text motion-reduce:!hidden lg:block"></span>
        <span data-train aria-hidden="true" class="absolute left-[calc(max(0px,(100%_-_90rem)/2)_+_9px)] top-[-15px] hidden motion-reduce:!hidden lg:block"><x-train /></span>

        {{-- THE LINE: the five stations every project rides. --}}
        <section data-station="The line" class="pb-16 md:pb-28 md:pt-28">
            <x-container>
                {{-- On phones this line continues the hero's trunk straight down. --}}
                <div data-ride="from-top" class="relative">
                    <span data-track aria-hidden="true" class="absolute left-[10px] top-0 w-1.5 bg-text lg:hidden"></span>
                    <span data-train aria-hidden="true" class="absolute left-[-2px] top-[-15px] motion-reduce:hidden lg:hidden"><x-train /></span>

                    <div class="relative">
                        <span data-stop aria-hidden="true" class="{{ $sectionStop }}"></span>
                        <x-sign class="relative z-10">The line</x-sign>
                    </div>
                    <p class="mt-6 max-w-prose pl-11 text-body-lg text-text-2 lg:pl-0">
                        Every project rides the same five stations, with the same team from the first call to launch.
                    </p>

                    <ol class="mt-12">
                        @foreach ($process as $stop)
                            <li class="relative grid gap-3 pb-12 pl-11 last:pb-0 lg:grid-cols-12 lg:gap-8 lg:pb-16 lg:pl-0">
                                <span data-stop aria-hidden="true" class="absolute left-[2px] top-[5px] h-[22px] w-[22px] rounded-full border-4 border-text bg-ground transition-colors duration-150 [&.is-passed]:bg-text lg:left-[-35px] lg:top-4"></span>
                                <h3 class="text-display-md font-extrabold stretch-condensed lg:col-span-3">{{ $stop['name'] }}</h3>
                                <p class="max-w-prose text-body-lg text-text-2 lg:col-span-5 lg:pt-2">{{ $stop['summary'] }}</p>
                                <div class="lg:col-span-4 lg:pt-2">
                                    <h4 class="text-body-sm font-semibold uppercase tracking-[0.06em] text-text-3">You get</h4>
                                    <ul class="mt-2 flex flex-wrap gap-x-5 gap-y-1.5 text-body-md lg:block lg:space-y-1.5">
                                        @foreach ($stop['gets'] as $get)
                                            <li class="flex gap-3"><span aria-hidden="true" class="mt-[0.6em] h-1.5 w-3 shrink-0 bg-text"></span>{{ $get }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </x-container>
        </section>

        {{-- PICK YOUR LINE: the five services, each drawn as its own line. --}}
        <section data-station="Pick your line" class="py-16 md:py-28">
            <x-container>
                <div class="relative">
                    <span data-stop aria-hidden="true" class="{{ $sectionStop }}"></span>
                    <x-sign :lines="$lineKeys">Pick your line</x-sign>
                </div>
                <p class="mt-6 max-w-prose text-body-lg text-text-2">
                    Five disciplines, one accountable team. Every line runs into the same trunk, so nothing gets lost between vendors.
                </p>

                {{-- Desktop: the lines as tabs; the chosen one comes forward. --}}
                <div x-data="{ active: 0 }" class="mt-12 hidden gap-12 lg:grid lg:grid-cols-12">
                    <div
                        role="tablist"
                        aria-label="Service lines"
                        aria-orientation="vertical"
                        class="flex flex-col lg:col-span-4"
                        @keydown.arrow-down.prevent="active = (active + 1) % {{ $services->count() }}; $nextTick(() => $el.querySelectorAll('[role=tab]')[active].focus())"
                        @keydown.arrow-up.prevent="active = (active + {{ $services->count() - 1 }}) % {{ $services->count() }}; $nextTick(() => $el.querySelectorAll('[role=tab]')[active].focus())"
                    >
                        @foreach ($services as $i => $service)
                            <button
                                type="button"
                                role="tab"
                                id="line-tab-{{ $i }}"
                                aria-controls="line-panel-{{ $i }}"
                                :aria-selected="active === {{ $i }}"
                                :tabindex="active === {{ $i }} ? 0 : -1"
                                @click="active = {{ $i }}"
                                class="group flex min-h-14 items-center gap-4 text-left"
                            >
                                <x-bullet :line="$service->line" />
                                <span class="text-heading-md font-bold stretch-semi transition-colors duration-150" :class="active === {{ $i }} ? 'text-text' : 'text-text-2 group-hover:text-text'">{{ $service->title }}</span>
                                <span aria-hidden="true" class="h-2.5 flex-1 transition-[opacity,transform] duration-300 ease-out-expo {{ $lineFill[$service->line] }}" :class="active === {{ $i }} ? 'opacity-100' : 'opacity-25 scale-y-50'"></span>
                            </button>
                        @endforeach
                    </div>

                    <div class="lg:col-span-8">
                        @foreach ($services as $i => $service)
                            <x-line-panel
                                :service="$service"
                                role="tabpanel"
                                id="line-panel-{{ $i }}"
                                aria-labelledby="line-tab-{{ $i }}"
                                tabindex="0"
                                x-show="active === {{ $i }}"
                                :x-cloak="$i > 0"
                            />
                        @endforeach
                    </div>
                </div>

                {{-- Phones and tablets: one line per swipe, with the bullets as a pager. --}}
                <div x-data="snapRow" class="mt-10 lg:hidden" role="region" aria-roledescription="carousel" aria-label="Service lines">
                    <div x-ref="row" class="-mx-5 flex snap-x snap-mandatory scroll-px-5 gap-4 overflow-x-auto px-5 pb-2 [scrollbar-width:none] sm:-mx-8 sm:scroll-px-8 sm:px-8">
                        @foreach ($services as $i => $service)
                            <x-line-panel
                                :service="$service"
                                role="group"
                                aria-roledescription="slide"
                                aria-label="{{ $i + 1 }} of {{ $services->count() }}: {{ $service->title }}"
                                class="w-[88%] shrink-0 snap-start bg-panel p-5 sm:w-[75%] md:p-8"
                            />
                        @endforeach
                    </div>
                    <div class="mt-5 flex items-center justify-between gap-4">
                        <div class="flex">
                            @foreach ($services as $i => $service)
                                <button type="button" @click="go({{ $i }})" class="grid h-11 w-11 place-items-center" :aria-current="index === {{ $i }}">
                                    <span class="sr-only">Show {{ $service->title }}</span>
                                    <span class="grid place-items-center rounded-full p-0.5 ring-2 transition-colors duration-150" :class="index === {{ $i }} ? 'ring-text' : 'ring-transparent'">
                                        <x-bullet :line="$service->line" size="sm" />
                                    </span>
                                </button>
                            @endforeach
                        </div>
                        <div class="flex gap-2">
                            <button type="button" @click="go(index - 1)" :disabled="index === 0" class="grid h-11 w-11 place-items-center ring-2 ring-inset ring-text disabled:opacity-30" aria-label="Previous line"><x-arrow dir="left" /></button>
                            <button type="button" @click="go(index + 1)" :disabled="index === count - 1" class="grid h-11 w-11 place-items-center ring-2 ring-inset ring-text disabled:opacity-30" aria-label="Next line"><x-arrow /></button>
                        </div>
                    </div>
                </div>
            </x-container>
        </section>

        {{-- JOURNEYS: case studies as platform posters. --}}
        @if ($featuredCaseStudies->isNotEmpty())
            <section data-station="Journeys" class="py-16 md:py-28">
                <x-container>
                    <div class="relative">
                        <span data-stop aria-hidden="true" class="{{ $sectionStop }}"></span>
                        <x-sign>Journeys</x-sign>
                    </div>
                    <div class="mt-6 flex flex-wrap items-end justify-between gap-x-8 gap-y-4">
                        <p class="max-w-prose text-body-lg text-text-2">
                            How an idea travels the line, from first call to launch.
                            @if ($featuredCaseStudies->contains('is_sample', true))
                                These are sample projects; real client work replaces them as it is cleared to publish.
                            @endif
                        </p>
                        <x-button :href="route('work.index')" variant="ghost">All journeys</x-button>
                    </div>

                    <x-poster-row class="mt-10" :studies="$featuredCaseStudies" :line-by-service="$lineByService" />
                </x-container>
            </section>
        @endif

        {{-- FARES: the three plans as tickets. --}}
        <section data-station="Fares" class="py-16 md:py-28">
            <x-container>
                <div class="relative">
                    <span data-stop aria-hidden="true" class="{{ $sectionStop }}"></span>
                    <x-sign>Fares</x-sign>
                </div>
                <p class="mt-6 max-w-prose text-body-lg text-text-2">Three ways to ride, from a first MVP to a full platform.</p>

                {{-- Phones swipe between tickets; the hero board already lists all three fares. --}}
                <div class="-mx-5 mt-10 flex snap-x snap-mandatory scroll-px-5 gap-4 overflow-x-auto px-5 pb-2 [scrollbar-width:none] sm:-mx-8 sm:scroll-px-8 sm:px-8 md:mx-0 md:mt-12 md:block md:space-y-6 md:overflow-visible md:px-0">
                    @foreach ($plans as $plan)
                        <x-ticket class="w-[88%] shrink-0 snap-start md:w-auto" :name="$plan->name" :tagline="$plan->tagline" :price="$plan->price_range" :duration="$plan->timeline" :best-for="$plan->best_for">
                            @if (! empty($plan->deliverables))
                                <x-slot:deliverables>
                                    <ul class="mt-6 hidden gap-x-8 gap-y-2 text-body-md text-text-2 md:grid md:grid-cols-2">
                                        @foreach (array_slice($plan->deliverables, 0, 4) as $item)
                                            <li class="flex gap-3"><span aria-hidden="true" class="mt-[0.6em] h-1.5 w-3 shrink-0 bg-text"></span>{{ $item }}</li>
                                        @endforeach
                                    </ul>
                                </x-slot:deliverables>
                            @endif
                            <x-slot:action>
                                <x-button :href="route('pricing')" variant="on-sign" size="sm">What's included</x-button>
                            </x-slot:action>
                        </x-ticket>
                    @endforeach
                </div>
            </x-container>
        </section>

        {{-- PLAN YOUR JOURNEY: the end of the ride. --}}
        <x-closing stop />
    </div>
</x-layout>
