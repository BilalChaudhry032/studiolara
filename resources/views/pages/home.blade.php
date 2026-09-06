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
                <x-hero-video label="Product showcase reel" />
            </div>
        </x-container>
    </section>

    {{-- CLIENT LOGOS MARQUEE --}}
    <section class="border-y border-ink-800 py-12">
        <p class="text-center text-body-sm uppercase tracking-widest text-muted">
            Trusted by founders across the US &amp; EU
        </p>
        <x-marquee speed="28" class="mt-8">
            @for ($i = 1; $i <= 6; $i++)
                <x-placeholder-image label="Client logo" ratio="aspect-[3/1]" class="w-48" />
            @endfor
        </x-marquee>
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
                    <div data-reveal>
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
                <x-stat-counter :target="150" suffix="+" label="Projects Delivered" />
                <x-stat-counter :target="8" suffix="+" label="Years in Business" />
                <x-stat-counter :target="40" suffix="%" label="Avg. Conversion Lift" />
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
                                    loading="lazy"
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

    {{-- SERVICE TAG STRIP (confirmed tapline pattern: marquee directly above the footer CTA) --}}
    <section class="border-t border-ink-800 py-6">
        <x-marquee speed="22">
            @foreach ($services->pluck('title') as $tag)
                <span class="rounded-full border border-ink-700 px-4 py-2 text-body-sm text-paper-dim">{{ $tag }}</span>
            @endforeach
        </x-marquee>
    </section>

    {{-- FOOTER CTA --}}
    <section class="relative overflow-hidden py-24">
        {{-- Ambient floating dots, confirmed live on tapline.studio's equivalent CTA section (see app.css .float-dot) --}}
        <span class="float-dot absolute left-[12%] top-[20%] h-1.5 w-1.5 rounded-full bg-lime-500/70" style="animation-delay:0s"></span>
        <span class="float-dot absolute left-[20%] top-[65%] h-1.5 w-1.5 rounded-full bg-lime-500/50" style="animation-delay:0.6s"></span>
        <span class="float-dot absolute left-[8%] top-[45%] h-1 w-1 rounded-full bg-paper/40" style="animation-delay:1.1s"></span>
        <span class="float-dot absolute right-[10%] top-[25%] h-1.5 w-1.5 rounded-full bg-paper/40" style="animation-delay:0.3s"></span>
        <span class="float-dot absolute right-[18%] top-[60%] h-1 w-1 rounded-full bg-lime-500/60" style="animation-delay:0.9s"></span>
        <span class="float-dot absolute right-[7%] top-[42%] h-1.5 w-1.5 rounded-full bg-lime-500/40" style="animation-delay:1.4s"></span>

        <x-container class="relative mx-auto max-w-2xl text-center">
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
