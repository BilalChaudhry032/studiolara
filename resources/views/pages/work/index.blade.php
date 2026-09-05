<x-layout
    title="Work"
    description="Case studies demonstrating measurable business outcomes across UI/UX, web, SaaS, mobile, and CMS projects."
>
    <section class="py-24 lg:py-32">
        <x-container class="mx-auto max-w-3xl text-center">
            <p class="text-eyebrow uppercase tracking-widest text-lime-500">Our Portfolio</p>
            <h1 class="mt-4 text-display-lg font-semibold text-paper">
                Unleashing the Power of Collaborative Creativity
            </h1>
            <p class="mt-6 text-body-lg text-paper-dim">
                Case studies demonstrating measurable business outcomes and technical depth.
            </p>
        </x-container>
    </section>

    {{-- CATEGORY TAG STRIP (static row for now — becomes a marquee-styled filter in Phase 4) --}}
    @if ($categories->isNotEmpty())
        <section class="border-y border-ink-800 py-6">
            <x-marquee speed="22">
                @foreach ($categories as $category)
                    <span class="rounded-full border border-ink-700 px-4 py-2 text-body-sm text-paper-dim">{{ $category }}</span>
                @endforeach
            </x-marquee>
        </section>
    @endif

    <section class="py-24">
        <x-container>
            @if ($projects->isEmpty())
                <p class="text-center text-body-md text-paper-dim">No projects published yet — check back soon.</p>
            @else
                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($projects as $project)
                        <a href="{{ route('work.show', $project) }}" class="group block">
                            @if ($project->getFirstMediaUrl('cover'))
                                <img
                                    src="{{ $project->getFirstMediaUrl('cover') }}"
                                    alt="{{ $project->title }}"
                                    loading="lazy"
                                    class="aspect-[4/3] w-full rounded-2xl border border-ink-700 object-cover transition-transform duration-500 group-hover:scale-[1.02]"
                                >
                            @else
                                <x-placeholder-image :label="$project->title" />
                            @endif

                            <div class="mt-4 flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-heading-md font-semibold text-paper">{{ $project->title }}</p>
                                    @if ($project->service_tags)
                                        <p class="mt-1 text-body-sm text-paper-dim">{{ implode(' · ', $project->service_tags) }}</p>
                                    @endif
                                </div>
                                <x-heroicon-o-arrow-up-right class="mt-1 h-5 w-5 shrink-0 text-paper-dim transition-colors duration-300 group-hover:text-lime-500" />
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </x-container>
    </section>

    @if ($categories->isNotEmpty())
        <section class="border-t border-ink-800 py-6">
            <x-marquee speed="22">
                @foreach ($categories as $category)
                    <span class="rounded-full border border-ink-700 px-4 py-2 text-body-sm text-paper-dim">{{ $category }}</span>
                @endforeach
            </x-marquee>
        </section>
    @endif
</x-layout>
