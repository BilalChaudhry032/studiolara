@php
    $names = $services->pluck('title', 'line');
@endphp

<x-layout
    title="Work"
    description="Journeys from idea to launch: product design, web, SaaS, mobile and CMS projects, drawn as the lines they rode."
>
    {{-- HERO --}}
    <section class="pt-10 md:pt-16 lg:pt-20">
        <x-container>
            <h1 class="text-balance text-display-xl font-extrabold stretch-condensed">Journeys</h1>
            <p class="mt-6 max-w-[52ch] text-body-lg text-text-2">
                How ideas travel the line, from the first call to launch.
                @if ($projects->contains('is_sample', true))
                    These are sample projects; real client work replaces them as it is cleared to publish.
                @endif
            </p>
        </x-container>
    </section>

    {{-- THE WALL: posters, filterable by line. --}}
    <section data-station="Journeys" class="py-12 md:py-20">
        <x-container x-data="journeyFilter({{ Js::from($names) }})">
            <div role="group" aria-label="Filter journeys by line" class="flex flex-wrap gap-2">
                <button
                    type="button"
                    @click="choose('')"
                    :aria-pressed="line === ''"
                    aria-pressed="true"
                    class="inline-flex min-h-11 items-center px-4 text-body-sm font-semibold ring-2 ring-inset ring-text transition-colors duration-150"
                    :class="line === '' ? 'bg-action text-action-ink' : 'hover:bg-panel'"
                >All lines</button>
                @foreach ($services as $service)
                    <button
                        type="button"
                        @click="choose('{{ $service->line }}')"
                        :aria-pressed="line === '{{ $service->line }}'"
                        aria-pressed="false"
                        class="inline-flex min-h-11 items-center gap-2 pl-1.5 pr-4 text-body-sm font-semibold ring-2 ring-inset ring-text transition-colors duration-150"
                        :class="line === '{{ $service->line }}' ? 'bg-action text-action-ink' : 'hover:bg-panel'"
                    >
                        <x-bullet :line="$service->line" size="sm" />
                        {{ $service->title }}
                    </button>
                @endforeach
            </div>
            <p class="mt-4 text-body-sm font-semibold text-text-2" aria-live="polite" x-text="summary">All {{ $projects->count() }} journeys</p>

            <div class="mt-10 grid gap-x-8 gap-y-14 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($projects as $project)
                    <div data-lines="{{ implode(' ', $project->linesFrom($lineByService)) }}" x-show="shows($el.dataset.lines)">
                        <x-poster
                            :href="route('work.show', $project)"
                            :title="$project->title"
                            :subtitle="implode(' · ', $project->service_tags ?? [])"
                            :lines="$project->linesFrom($lineByService)"
                            :image="$project->getFirstMediaUrl('cover', 'medium') ?: null"
                            :alt="'Product screens from the ' . $project->title . ' project'"
                            :sample="$project->is_sample"
                        />
                    </div>
                @endforeach
            </div>

            <div x-show="count === 0" x-cloak class="mt-10 bg-panel p-8">
                <p class="text-heading-md font-bold stretch-semi">No journeys on this line yet.</p>
                @foreach ($services as $service)
                    <a x-show="line === '{{ $service->line }}'" href="{{ route('services.show', $service) }}" class="mt-3 inline-flex min-h-11 items-center gap-2 font-semibold underline decoration-2 underline-offset-[0.3em]">
                        See what the {{ $service->title }} line covers <x-arrow />
                    </a>
                @endforeach
            </div>
        </x-container>
    </section>

    <x-closing />
</x-layout>
