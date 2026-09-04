<x-layout
    title="Services"
    description="UI/UX Design, Web Development, SaaS Product Development, Mobile App Design & Dev, and CMS Development — five disciplines, one accountable team."
>
    {{-- HERO --}}
    <section class="py-24 lg:py-32">
        <x-container class="mx-auto max-w-3xl text-center">
            <p class="text-eyebrow uppercase tracking-widest text-lime-500">Our Services</p>
            <h1 class="mt-4 text-display-lg font-semibold text-paper">
                Design & Development Services Engineered for Growth
            </h1>
            <p class="mt-6 text-body-lg text-paper-dim">
                Product strategy, conversion-focused design, and scalable engineering — under one accountable team,
                not handed off between vendors.
            </p>
            <div class="mt-8">
                <x-button href="{{ route('contact') }}" variant="primary">Get Started</x-button>
            </div>
        </x-container>
    </section>

    @php($tagStrip = $services->pluck('title'))

    {{-- SERVICE TAG STRIP (static row for now — becomes a marquee divider in Phase 4) --}}
    <section class="border-y border-ink-800 py-6">
        <x-container class="flex flex-wrap justify-center gap-3">
            @foreach ($tagStrip as $tag)
                <span class="rounded-full border border-ink-700 px-4 py-2 text-body-sm text-paper-dim">{{ $tag }}</span>
            @endforeach
        </x-container>
    </section>

    {{-- DETAILED SERVICE CARDS --}}
    <section class="py-24">
        <x-container class="space-y-8">
            @foreach ($services as $service)
                <x-card class="lg:p-10">
                    <div class="grid gap-8 lg:grid-cols-[1.2fr_1fr]">
                        <div>
                            <p class="text-heading-lg font-semibold text-paper">{{ $service->title }}</p>
                            <p class="mt-4 text-body-md text-paper-dim">{{ $service->description }}</p>
                            <div class="mt-6">
                                <x-button href="{{ route('contact') }}" variant="outline">Request This Service</x-button>
                            </div>
                        </div>
                        <div class="space-y-4 border-t border-ink-700 pt-6 lg:border-l lg:border-t-0 lg:pl-8 lg:pt-0">
                            @if ($service->tools_technologies)
                                <div>
                                    <p class="text-body-sm uppercase tracking-widest text-muted">Tools & Technologies</p>
                                    <p class="mt-1 text-body-sm text-paper-dim">{{ implode(', ', $service->tools_technologies) }}</p>
                                </div>
                            @endif
                            @if ($service->best_for)
                                <div>
                                    <p class="text-body-sm uppercase tracking-widest text-muted">Best For</p>
                                    <p class="mt-1 text-body-sm text-paper-dim">{{ $service->best_for }}</p>
                                </div>
                            @endif
                            @if ($service->use_cases)
                                <div>
                                    <p class="text-body-sm uppercase tracking-widest text-muted">Use Cases</p>
                                    <p class="mt-1 text-body-sm text-paper-dim">{{ implode(', ', $service->use_cases) }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </x-card>
            @endforeach
        </x-container>
    </section>

    {{-- SERVICE TAG STRIP (repeated as section divider) --}}
    <section class="border-y border-ink-800 py-6">
        <x-container class="flex flex-wrap justify-center gap-3">
            @foreach ($tagStrip as $tag)
                <span class="rounded-full border border-ink-700 px-4 py-2 text-body-sm text-paper-dim">{{ $tag }}</span>
            @endforeach
        </x-container>
    </section>

    {{-- PROCESS --}}
    <section class="py-24">
        <x-container>
            <x-section-heading eyebrow="Our Process" subtext="A methodology designed for clarity and momentum, from first call to launch.">
                Discover. Define. Design. Build. Refine.
            </x-section-heading>

            <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-5">
                @foreach ([
                    ['step' => '01', 'name' => 'Discover', 'blurb' => 'We align on your goals, users, and business model before anything else.'],
                    ['step' => '02', 'name' => 'Define', 'blurb' => 'Research becomes a focused product strategy and a clear, scoped plan.'],
                    ['step' => '03', 'name' => 'Design', 'blurb' => 'High-quality design concepts built with conversion and clarity in mind.'],
                    ['step' => '04', 'name' => 'Build', 'blurb' => 'A polished, final experience — fast, scalable, and ready to perform.'],
                    ['step' => '05', 'name' => 'Refine', 'blurb' => 'We refine based on real feedback and performance data after launch.'],
                ] as $step)
                    <div>
                        <p class="text-eyebrow text-lime-500">{{ $step['step'] }}</p>
                        <p class="mt-3 text-heading-md font-semibold text-paper">{{ $step['name'] }}</p>
                        <p class="mt-2 text-body-sm text-paper-dim">{{ $step['blurb'] }}</p>
                    </div>
                @endforeach
            </div>
        </x-container>
    </section>

    {{-- CORE PROMISE + STATS --}}
    <section class="border-t border-ink-800 py-24">
        <x-container class="grid gap-16 lg:grid-cols-2 lg:items-center">
            <div>
                <x-section-heading eyebrow="Our Promise">
                    Business-Driven Strategy, Premium Craft, Built for Scale
                </x-section-heading>
                <ul class="mt-8 space-y-4">
                    @foreach ([
                        'Every interface is designed to feel sharp, modern, and credible',
                        'Clean, maintainable foundations that evolve with your product',
                        'Clear communication and visible progress at every stage',
                    ] as $point)
                        <li class="flex items-start gap-3 text-body-md text-paper-dim">
                            <x-heroicon-o-check-circle class="mt-0.5 h-5 w-5 shrink-0 text-lime-500" />
                            {{ $point }}
                        </li>
                    @endforeach
                </ul>
                <div class="mt-8">
                    <x-button href="{{ route('contact') }}" variant="primary">Book Your Free Strategy Call Today</x-button>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-6 rounded-2xl border border-ink-700 bg-ink-900 p-8 text-center">
                <div>
                    <p class="text-display-md font-semibold text-lime-500">150+</p>
                    <p class="mt-2 text-body-sm text-paper-dim">Projects Delivered</p>
                </div>
                <div>
                    <p class="text-display-md font-semibold text-lime-500">8+</p>
                    <p class="mt-2 text-body-sm text-paper-dim">Years in Business</p>
                </div>
                <div>
                    <p class="text-display-md font-semibold text-lime-500">40%</p>
                    <p class="mt-2 text-body-sm text-paper-dim">Avg. Conversion Lift</p>
                </div>
            </div>
        </x-container>
    </section>

    {{-- SERVICE TAG STRIP (again) --}}
    <section class="border-y border-ink-800 py-6">
        <x-container class="flex flex-wrap justify-center gap-3">
            @foreach ($tagStrip as $tag)
                <span class="rounded-full border border-ink-700 px-4 py-2 text-body-sm text-paper-dim">{{ $tag }}</span>
            @endforeach
        </x-container>
    </section>

    {{-- PORTFOLIO TEASER --}}
    @if ($featuredCaseStudies->isNotEmpty())
        <section class="py-24">
            <x-container>
                <div class="flex flex-wrap items-end justify-between gap-4">
                    <x-section-heading eyebrow="Selected Work">Recent Case Studies</x-section-heading>
                    <x-button href="{{ route('work.index') }}" variant="ghost">View All Projects</x-button>
                </div>

                <div class="mt-12 grid gap-6 md:grid-cols-3">
                    @foreach ($featuredCaseStudies as $project)
                        <a href="{{ route('work.show', $project) }}" class="group block">
                            @if ($project->getFirstMediaUrl('cover'))
                                <img
                                    src="{{ $project->getFirstMediaUrl('cover') }}"
                                    alt="{{ $project->title }}"
                                    class="aspect-[4/3] w-full rounded-2xl border border-ink-700 object-cover"
                                >
                            @else
                                <x-placeholder-image :label="$project->title" />
                            @endif
                            <p class="mt-4 text-heading-md font-semibold text-paper">{{ $project->title }}</p>
                            <p class="mt-1 text-body-sm text-paper-dim">{{ $project->category }}</p>
                        </a>
                    @endforeach
                </div>
            </x-container>
        </section>
    @endif

    {{-- TESTIMONIAL --}}
    @if ($testimonial)
        <section class="border-t border-ink-800 py-24">
            <x-container class="mx-auto max-w-3xl text-center">
                <x-heroicon-s-chat-bubble-left-right class="mx-auto h-8 w-8 text-lime-500" />
                <blockquote class="mt-6 text-heading-lg font-medium text-paper">
                    &ldquo;{{ $testimonial->quote }}&rdquo;
                </blockquote>
                <p class="mt-6 text-body-sm text-paper-dim">
                    — {{ $testimonial->author_name }}{{ $testimonial->author_title ? ', ' . $testimonial->author_title : '' }}{{ $testimonial->company ? ' of ' . $testimonial->company : '' }}
                </p>
            </x-container>
        </section>
    @endif

    {{-- FOOTER CTA --}}
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
