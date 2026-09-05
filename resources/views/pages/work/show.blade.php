<x-layout
    :title="$project->title"
    :description="str($project->about)->limit(155)"
    :image="$project->getFirstMediaUrl('cover') ?: null"
>
    {{-- 1. Hero image --}}
    <section class="pt-12">
        <x-container>
            @if ($project->getFirstMediaUrl('cover'))
                <img
                    src="{{ $project->getFirstMediaUrl('cover') }}"
                    alt="{{ $project->title }}"
                    class="aspect-video w-full rounded-2xl border border-ink-700 object-cover"
                >
            @else
                <x-placeholder-image :label="$project->title" ratio="aspect-video" />
            @endif
        </x-container>
    </section>

    {{-- 2. About the Project --}}
    <section class="py-16">
        <x-container class="mx-auto max-w-3xl">
            <p class="text-eyebrow uppercase tracking-widest text-lime-500">About the Project</p>
            <h1 class="mt-4 text-display-md font-semibold text-paper">{{ $project->title }}</h1>
            <p class="mt-6 text-body-lg text-paper-dim">{{ $project->about }}</p>
        </x-container>
    </section>

    {{-- 3. Meta row --}}
    <section class="border-y border-ink-800 py-10">
        <x-container class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
            <div>
                <p class="text-body-sm uppercase tracking-widest text-muted">Project</p>
                <p class="mt-2 text-body-md text-paper">{{ $project->title }}</p>
            </div>
            <div>
                <p class="text-body-sm uppercase tracking-widest text-muted">Category</p>
                <p class="mt-2 text-body-md text-paper">{{ $project->category ?? '—' }}</p>
            </div>
            <div>
                <p class="text-body-sm uppercase tracking-widest text-muted">Tools</p>
                <p class="mt-2 text-body-md text-paper">{{ $project->tools ? implode(', ', $project->tools) : '—' }}</p>
            </div>
            <div>
                <p class="text-body-sm uppercase tracking-widest text-muted">Service Tags</p>
                <p class="mt-2 text-body-md text-paper">{{ $project->service_tags ? implode(', ', $project->service_tags) : '—' }}</p>
            </div>
        </x-container>
    </section>

    {{-- 4. Challenges We Faced --}}
    @if ($project->challenges)
        <section class="py-16">
            <x-container class="mx-auto max-w-3xl">
                <h2 class="text-heading-lg font-semibold text-paper">Challenges We Faced</h2>
                <ol class="mt-6 space-y-4">
                    @foreach ($project->challenges as $index => $challenge)
                        <li class="flex gap-4 text-body-md text-paper-dim">
                            <span class="text-heading-md font-semibold text-lime-500">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="pt-1">{{ $challenge }}</span>
                        </li>
                    @endforeach
                </ol>
            </x-container>
        </section>
    @endif

    {{-- 5. Supporting screenshot(s) --}}
    @if ($project->getMedia('gallery')->isNotEmpty())
        <section class="border-t border-ink-800 py-16">
            <x-container class="grid gap-6 sm:grid-cols-2">
                @foreach ($project->getMedia('gallery') as $media)
                    <img src="{{ $media->getUrl() }}" alt="" loading="lazy" class="aspect-[4/3] w-full rounded-2xl border border-ink-700 object-cover">
                @endforeach
            </x-container>
        </section>
    @endif

    {{-- 6. Problems & Their Solutions --}}
    @if ($project->problems_solutions)
        <section class="border-t border-ink-800 py-16">
            <x-container class="mx-auto max-w-3xl">
                <h2 class="text-heading-lg font-semibold text-paper">Problems &amp; Their Solutions</h2>
                <div class="mt-6 space-y-8">
                    @foreach ($project->problems_solutions as $index => $pair)
                        <div>
                            <p class="text-body-sm uppercase tracking-widest text-muted">Problem {{ $index + 1 }}</p>
                            <p class="mt-2 text-body-md text-paper">{{ $pair['problem'] }}</p>
                            <p class="mt-4 text-body-sm uppercase tracking-widest text-lime-500">Solution</p>
                            <p class="mt-2 text-body-md text-paper-dim">{{ $pair['solution'] }}</p>
                        </div>
                    @endforeach
                </div>
            </x-container>
        </section>
    @endif

    {{-- 8. Outcome & Results --}}
    @if ($project->outcome_results)
        <section class="border-t border-ink-800 py-16">
            <x-container class="mx-auto max-w-3xl">
                <h2 class="text-heading-lg font-semibold text-paper">Outcome &amp; Results</h2>
                <p class="mt-6 text-body-lg text-paper-dim">{{ $project->outcome_results }}</p>
            </x-container>
        </section>
    @endif

    {{-- 9. Client testimonial --}}
    @if ($project->testimonial_quote)
        <section class="border-t border-ink-800 py-16">
            <x-container class="mx-auto max-w-3xl text-center">
                <x-heroicon-s-chat-bubble-left-right class="mx-auto h-8 w-8 text-lime-500" />
                <blockquote class="mt-6 text-heading-lg font-medium text-paper">
                    &ldquo;{{ $project->testimonial_quote }}&rdquo;
                </blockquote>
                <p class="mt-6 text-body-sm text-paper-dim">
                    — {{ $project->testimonial_author }}{{ $project->testimonial_title ? ', ' . $project->testimonial_title : '' }}
                </p>
            </x-container>
        </section>
    @endif

    {{-- 10. Footer CTA --}}
    <section class="border-t border-ink-800 py-24">
        <x-container class="mx-auto max-w-2xl text-center">
            <h2 class="text-display-md font-semibold text-paper">Let's Build Something Great Together</h2>
            <p class="mt-4 text-body-lg text-paper-dim">
                Ready to turn your idea into a digital product? We're here to listen, strategize, and bring your vision to life.
            </p>
            <div class="mt-8">
                <x-button href="{{ route('contact') }}" variant="primary">Book Your Free Strategy Call Today</x-button>
            </div>
        </x-container>
    </section>
</x-layout>
