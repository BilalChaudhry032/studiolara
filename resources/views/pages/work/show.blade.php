@php
    $lines = $project->linesFrom($lineByService);
    $before = $project->getFirstMedia('before');
    $after = $project->getFirstMedia('after');
    $video = $project->videoSources();
    $poster = $project->getFirstMediaUrl('video_poster', 'large') ?: null;
    $gallery = $project->getMedia('gallery');
    $label = 'text-body-sm font-semibold uppercase tracking-[0.06em] text-text-3';
    $stop = 'absolute left-[2px] top-[3px] h-[22px] w-[22px] rounded-full border-4 border-text bg-ground transition-colors duration-150 [&.is-passed]:bg-text';
    $showTestimonial = $project->testimonial_quote && ! $project->is_sample;
@endphp

<x-layout
    :title="$project->title"
    :description="str($project->about)->limit(155)"
    :image="$after?->getUrl('large') ?: ($project->getFirstMediaUrl('cover', 'large') ?: null)"
>
    {{-- HERO: the story and the facts of the journey. --}}
    <section class="pt-8 md:pt-12">
        <x-container>
            <nav aria-label="Breadcrumb">
                <ol class="flex flex-wrap items-center gap-2 text-body-sm font-semibold text-text-2">
                    <li><a href="{{ route('work.index') }}" class="inline-flex min-h-11 items-center underline decoration-text/40 decoration-2 underline-offset-[0.3em] hover:decoration-text">All journeys</a></li>
                    <li aria-hidden="true">/</li>
                    <li aria-current="page">{{ $project->title }}</li>
                </ol>
            </nav>

            <div class="mt-6 grid gap-10 lg:grid-cols-12 lg:items-start">
                <div class="lg:col-span-7">
                    @if ($project->is_sample)
                        <p class="inline-block bg-sign px-2.5 py-1 text-body-sm font-bold uppercase tracking-[0.06em] text-sign-ink stretch-condensed">Sample project</p>
                    @endif
                    <h1 class="mt-4 text-balance text-display-xl font-extrabold stretch-condensed">{{ $project->title }}</h1>
                    <p class="mt-6 max-w-[52ch] text-body-lg text-text-2">{{ $project->about }}</p>
                </div>

                <dl class="divide-y divide-rule bg-panel px-6 py-2 lg:col-span-5">
                    @if ($lines)
                        <div class="py-4">
                            <dt class="{{ $label }}">Lines ridden</dt>
                            <dd class="mt-3 space-y-2">
                                @foreach ($project->service_tags as $tag)
                                    @if (isset($lineByService[$tag]))
                                        @php($service = $services->firstWhere('title', $tag))
                                        <a href="{{ route('services.show', $service) }}" class="group flex min-h-11 items-center gap-3 font-semibold">
                                            <x-bullet :line="$lineByService[$tag]" size="sm" />
                                            <span class="underline decoration-transparent decoration-2 underline-offset-[0.3em] group-hover:decoration-current">{{ $tag }}</span>
                                        </a>
                                    @endif
                                @endforeach
                            </dd>
                        </div>
                    @endif
                    @if ($project->duration_label)
                        <div class="flex items-baseline justify-between gap-4 py-4">
                            <dt class="{{ $label }}">Journey time</dt>
                            <dd class="text-heading-md font-bold stretch-condensed">{{ $project->duration_label }}</dd>
                        </div>
                    @endif
                    @if (! empty($project->tools))
                        <div class="py-4">
                            <dt class="{{ $label }}">Tools</dt>
                            <dd class="mt-3 flex flex-wrap gap-2">
                                @foreach ($project->tools as $tool)
                                    <span class="px-3 py-1.5 text-body-sm font-semibold ring-2 ring-inset ring-text">{{ $tool }}</span>
                                @endforeach
                            </dd>
                        </div>
                    @endif
                    <div class="flex items-baseline justify-between gap-4 py-4">
                        <dt class="{{ $label }}">Client</dt>
                        <dd class="font-semibold">{{ $project->is_sample ? 'Sample project, not a client' : $project->client }}</dd>
                    </div>
                </dl>
            </div>
        </x-container>
    </section>

    {{-- DEPARTURE → ARRIVAL --}}
    @if ($before && $after)
        <section data-station="Departure" class="pt-16 md:pt-24">
            <x-container>
                <x-sign arrow="right">Departure to arrival</x-sign>
                <x-compare class="mt-8" :before="$before" :after="$after" :label="$project->title">
                    <x-slot:caption>Drag or use the arrow keys to compare the product before and after the project.{{ $project->is_sample ? ' Sample screens of a fictional product.' : '' }}</x-slot:caption>
                </x-compare>
            </x-container>
        </section>
    @endif

    {{-- THE ROUTE: where it started, then each problem and what we did. --}}
    @if ($project->challenges || $project->problems_solutions)
        <section data-station="The route" class="py-16 md:py-24">
            <x-container>
                <x-sign>The route</x-sign>
                <div data-ride="from-top" class="relative mt-10">
                    <span data-track aria-hidden="true" class="absolute left-[10px] top-0 w-1.5 bg-text"></span>
                    <span data-train aria-hidden="true" class="absolute left-[-2px] top-[-15px] motion-reduce:hidden"><x-train /></span>

                    <ol>
                        @if ($project->challenges)
                            <li class="relative pb-12 pl-12">
                                <span data-stop aria-hidden="true" class="{{ $stop }}"></span>
                                <h3 class="text-heading-lg font-extrabold stretch-condensed">Where it started</h3>
                                <ul class="mt-4 max-w-prose space-y-2 text-body-lg text-text-2">
                                    @foreach ($project->challenges as $challenge)
                                        <li class="flex gap-3"><span aria-hidden="true" class="mt-[0.65em] h-1.5 w-3 shrink-0 bg-text"></span>{{ $challenge }}</li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                        @foreach ($project->problems_solutions ?? [] as $pair)
                            <li class="relative pb-12 pl-12 last:pb-0">
                                <span data-stop aria-hidden="true" class="{{ $stop }}"></span>
                                <div class="grid gap-6 lg:grid-cols-2 lg:gap-12">
                                    <div>
                                        <h3 class="{{ $label }}">The problem</h3>
                                        <p class="mt-2 text-heading-md font-semibold stretch-semi">{{ $pair['problem'] }}</p>
                                    </div>
                                    <div>
                                        <h3 class="{{ $label }}">What we did</h3>
                                        <p class="mt-2 text-heading-md font-bold stretch-semi">{{ $pair['solution'] }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </x-container>
        </section>
    @endif

    {{-- WALKTHROUGH AND GALLERY --}}
    @if ($video || $gallery->isNotEmpty())
        <section data-station="Walkthrough" class="py-16 md:py-24">
            <x-container>
                <x-sign>Walkthrough</x-sign>
                @if ($video)
                    <x-video class="mt-8" :sources="$video" :poster="$poster" :label="'Walkthrough of the ' . $project->title . ' product'">
                        <x-slot:caption>A short, silent walkthrough of the finished product.{{ $project->is_sample ? ' Sample product.' : '' }}</x-slot:caption>
                    </x-video>
                @endif
                @if ($gallery->isNotEmpty())
                    <div class="mt-8 grid gap-8 md:grid-cols-2">
                        @foreach ($gallery as $image)
                            {{-- A 16:10 frame, so tall phone screens sit centred instead of towering over the page. --}}
                            <div class="aspect-[16/10] border-4 border-text bg-panel">
                                <img
                                    src="{{ $image->getUrl('large') }}"
                                    srcset="{{ $image->getUrl('medium') }} 960w, {{ $image->getUrl('large') }} 1920w"
                                    sizes="(min-width: 768px) 50vw, 100vw"
                                    alt="{{ $image->getCustomProperty('alt', 'Another screen from the ' . $project->title . ' project') }}"
                                    loading="lazy"
                                    class="h-full w-full object-contain"
                                >
                            </div>
                        @endforeach
                    </div>
                @endif
            </x-container>
        </section>
    @endif

    {{-- ARRIVAL --}}
    @if ($project->outcome_results || $project->headline_result)
        <section data-station="Arrival" class="py-16 md:py-24">
            <x-container>
                <x-sign>Arrival</x-sign>
                <div class="mt-10 grid gap-8 lg:grid-cols-12 lg:items-end">
                    @if ($project->headline_result)
                        <p class="text-balance text-display-lg font-extrabold stretch-condensed lg:col-span-7">{{ $project->headline_result }}</p>
                    @endif
                    @if ($project->outcome_results)
                        <p class="max-w-prose text-body-lg text-text-2 lg:col-span-5">{{ $project->outcome_results }}</p>
                    @endif
                </div>

                @if ($showTestimonial)
                    <figure class="mt-14 max-w-4xl">
                        <blockquote class="text-heading-lg font-semibold stretch-semi">&ldquo;{{ $project->testimonial_quote }}&rdquo;</blockquote>
                        <figcaption class="mt-4 text-body-md text-text-2">{{ $project->testimonial_author }}{{ $project->testimonial_title ? ', ' . $project->testimonial_title : '' }}</figcaption>
                    </figure>
                @endif
            </x-container>
        </section>
    @endif

    {{-- NEXT JOURNEY --}}
    @if ($next)
        <section data-station="Next journey" class="py-16 md:py-24">
            <x-container class="grid gap-8 md:grid-cols-12 md:items-center">
                <div class="md:col-span-7">
                    <x-sign arrow="right">Next journey</x-sign>
                    <p class="mt-6 text-display-md font-extrabold stretch-condensed">{{ $next->title }}</p>
                    <p class="mt-3 text-body-lg text-text-2">{{ str($next->about)->limit(140) }}</p>
                </div>
                <x-poster
                    class="md:col-span-4 md:col-start-9"
                    :href="route('work.show', $next)"
                    :title="$next->title"
                    :subtitle="implode(' · ', $next->service_tags ?? [])"
                    :lines="$next->linesFrom($lineByService)"
                    :image="$next->getFirstMediaUrl('cover', 'medium') ?: null"
                    :alt="'Product screens from the ' . $next->title . ' project'"
                    :sample="$next->is_sample"
                />
            </x-container>
        </section>
    @endif

    <x-closing>Tell us where your product is now and where it needs to be, and we'll plan the route with you.</x-closing>
</x-layout>
