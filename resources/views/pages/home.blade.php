<x-layout
    title="Home"
    description="We design & build digital products that actually grow businesses — strategy-first discovery, premium UX/UI, and scalable engineering for ambitious startups and growth-stage teams."
>
    {{-- HERO --}}
    <section class="relative overflow-hidden py-24 lg:py-32">
        <p
            aria-hidden="true"
            class="pointer-events-none absolute inset-x-0 top-8 select-none whitespace-nowrap text-center text-[18vw] font-semibold leading-none text-ink-800/60 lg:text-[14rem]"
        >
            STUDIO
        </p>

        <x-container class="relative">
            <div class="mx-auto max-w-4xl text-center">
                <h1 class="text-display-xl font-semibold text-paper">
                    We Design &amp; Build Digital Products That Actually Grow Businesses
                </h1>
                <p class="mx-auto mt-6 max-w-2xl text-body-lg text-paper-dim">
                    We help ambitious startups and growing companies turn ideas into polished digital
                    experiences that attract attention, convert visitors, and support long-term business growth.
                </p>

                <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                    <x-button href="{{ route('contact') }}" variant="primary">Book Your Free Strategy Call Today</x-button>
                    <x-button href="{{ route('work.index') }}" variant="outline">See Case Studies &amp; Recent Work</x-button>
                </div>

                <p class="mt-8 text-body-sm uppercase tracking-widest text-muted">
                    8+ Years in Business &nbsp;·&nbsp; 150+ Projects Completed &nbsp;·&nbsp; 60+ Clients Served
                </p>
            </div>

            <div class="mx-auto mt-16 max-w-3xl">
                <x-placeholder-image label="Product showcase reel (video in Phase 4)" ratio="aspect-video" />
            </div>
        </x-container>
    </section>

    {{-- CLIENT LOGOS (static grid for now — becomes a marquee in Phase 4) --}}
    <section class="border-y border-ink-800 py-12">
        <x-container>
            <p class="text-center text-body-sm uppercase tracking-widest text-muted">
                Trusted by founders across the US &amp; EU
            </p>
            <div class="mt-8 grid grid-cols-2 gap-6 sm:grid-cols-3 lg:grid-cols-6">
                @for ($i = 1; $i <= 6; $i++)
                    <x-placeholder-image label="Client logo" ratio="aspect-[3/1]" />
                @endfor
            </div>
        </x-container>
    </section>

    {{-- VALUE PROPOSITION / BENEFIT CARDS --}}
    <section class="py-24">
        <x-container>
            <x-section-heading
                eyebrow="Our Approach"
                align="center"
                subtext="Most agencies focus on deliverables. We focus on outcomes — blending product strategy, conversion-focused design, and robust engineering."
                class="mx-auto"
            >
                Not Just Design. Not Just Development. Real Product Impact.
            </x-section-heading>

            <div class="mt-12 grid gap-6 sm:grid-cols-3">
                <x-card>
                    <p class="text-heading-md font-semibold text-paper">Product-First Thinking</p>
                    <p class="mt-2 text-body-sm text-paper-dim">
                        We design around user journeys, business objectives, and product-market fit — not just visuals.
                    </p>
                </x-card>
                <x-card>
                    <p class="text-heading-md font-semibold text-paper">Conversion-Driven Design</p>
                    <p class="mt-2 text-body-sm text-paper-dim">
                        Every page, interaction, and CTA is optimized to move visitors forward, not just look good.
                    </p>
                </x-card>
                <x-card>
                    <p class="text-heading-md font-semibold text-paper">Scalable Engineering</p>
                    <p class="mt-2 text-body-sm text-paper-dim">
                        Clean, robust development architecture built to grow with your team, roadmap, and traffic.
                    </p>
                </x-card>
            </div>
        </x-container>
    </section>

    {{-- SERVICES GRID --}}
    <section class="border-t border-ink-800 py-24">
        <x-container>
            <x-section-heading eyebrow="What We Do" subtext="Five core disciplines, one accountable team.">
                Services Built Around Business Outcomes
            </x-section-heading>

            <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($services as $service)
                    <a href="{{ route('contact') }}" class="group block">
                        <x-card class="h-full transition-colors duration-300 group-hover:border-lime-500">
                            <div class="flex items-start justify-between gap-4">
                                <p class="text-heading-md font-semibold text-paper">{{ $service->title }}</p>
                                <x-heroicon-o-arrow-up-right class="h-5 w-5 shrink-0 text-paper-dim transition-colors duration-300 group-hover:text-lime-500" />
                            </div>
                            <p class="mt-3 text-body-sm text-paper-dim">{{ str($service->description)->limit(110) }}</p>
                        </x-card>
                    </a>
                @endforeach
            </div>
        </x-container>
    </section>

    {{-- PROCESS --}}
    <section class="border-t border-ink-800 py-24">
        <x-container>
            <x-section-heading eyebrow="Our Process" subtext="A methodology designed for clarity and momentum.">
                Discover. Define. Design. Build. Refine.
            </x-section-heading>

            <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-5">
                @foreach ([
                    ['step' => '01', 'name' => 'Discover', 'blurb' => 'Understand your users, business model, and goals.'],
                    ['step' => '02', 'name' => 'Define', 'blurb' => 'Translate research into a focused strategy and scope.'],
                    ['step' => '03', 'name' => 'Design', 'blurb' => 'Design with conversion, clarity, and confidence in mind.'],
                    ['step' => '04', 'name' => 'Build', 'blurb' => 'Build with scalability, performance, and stability at the core.'],
                    ['step' => '05', 'name' => 'Refine', 'blurb' => 'Refine based on real feedback and performance data.'],
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

    {{-- WHY CHOOSE US + STATS --}}
    <section class="border-t border-ink-800 py-24">
        <x-container class="grid gap-16 lg:grid-cols-2 lg:items-center">
            <div>
                <x-section-heading eyebrow="Why Choose Us">
                    Senior-Level Thinking, From Discovery Through Launch
                </x-section-heading>
                <ul class="mt-8 space-y-4">
                    @foreach ([
                        'Senior-level thinking from discovery through launch',
                        'Tailored solutions instead of one-size-fits-all templates',
                        'Clear priorities that reduce wasted time and scope creep',
                        'Design and development aligned around measurable business outcomes',
                    ] as $point)
                        <li class="flex items-start gap-3 text-body-md text-paper-dim">
                            <x-heroicon-o-check-circle class="mt-0.5 h-5 w-5 shrink-0 text-lime-500" />
                            {{ $point }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="grid grid-cols-3 gap-6 rounded-2xl border border-ink-700 bg-ink-900 p-8 text-center">
                {{-- Static numbers for now; Phase 4 swaps these for the odometer-style counter component --}}
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

    {{-- PORTFOLIO TEASER --}}
    @if ($featuredCaseStudies->isNotEmpty())
        <section class="border-t border-ink-800 py-24">
            <x-container>
                <div class="flex flex-wrap items-end justify-between gap-4">
                    <x-section-heading eyebrow="Selected Work">
                        Recent Case Studies
                    </x-section-heading>
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
