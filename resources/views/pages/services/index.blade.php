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

    {{-- SERVICE TAG STRIP (static row for now — becomes a marquee divider in Phase 4) --}}
    <section class="border-y border-ink-800 py-6">
        <x-container class="flex flex-wrap justify-center gap-3">
            @foreach (['UI/UX Design', 'Web Development', 'SaaS Product Development', 'Mobile App Design & Dev', 'CMS Development'] as $tag)
                <span class="rounded-full border border-ink-700 px-4 py-2 text-body-sm text-paper-dim">{{ $tag }}</span>
            @endforeach
        </x-container>
    </section>

    {{-- DETAILED SERVICE CARDS --}}
    <section class="py-24">
        <x-container class="space-y-8">
            @foreach ([
                [
                    'name' => 'UI/UX Design',
                    'desc' => 'We design intuitive, conversion-focused digital experiences that connect brand, strategy, and usability. Deliverables include user research, journey mapping, wireframes, prototypes, design systems, and polished UI for SaaS dashboards, marketing sites, and mobile products.',
                    'tools' => 'Figma, FigJam, Adobe XD, design systems, accessibility best practices, usability testing.',
                    'bestFor' => 'Startups, product teams, and companies redesigning complex experiences or launching new digital products.',
                    'useCases' => 'SaaS onboarding, dashboard redesigns, mobile app flows, product validation, high-converting landing pages.',
                ],
                [
                    'name' => 'Web Development',
                    'desc' => 'We build fast, scalable websites and web applications with clean architecture and performance in mind. From interactive marketing websites to robust platforms, we develop responsive experiences that are SEO-ready, maintainable, and built to support growth.',
                    'tools' => 'React, Next.js, TypeScript, modern CMS integrations, APIs, performance optimization, technical SEO.',
                    'bestFor' => 'Growth-stage businesses, founders, and teams that need a high-performance digital presence or custom web product.',
                    'useCases' => 'Corporate websites, product launch pages, platform experiences, lead generation sites, custom web apps.',
                ],
                [
                    'name' => 'SaaS Product Development',
                    'desc' => 'We take SaaS ideas from concept to launch with product strategy, UX, and engineering aligned from day one. We help define MVP scope, build multi-tenant systems, design subscription flows, and create dashboards that make complex workflows feel simple.',
                    'tools' => 'Full-stack development, subscription architecture, admin dashboards, analytics, API-first systems.',
                    'bestFor' => 'SaaS founders, product-led teams, and businesses launching software products or expanding platform capabilities.',
                    'useCases' => 'MVPs, customer portals, internal tools, subscription products, enterprise-ready software platforms.',
                ],
                [
                    'name' => 'Mobile App Design & Dev',
                    'desc' => 'We create mobile experiences that feel premium, clear, and effortless across iOS and Android. Our process combines product thinking, interaction design, and cross-platform engineering to deliver apps ready for real users and real-world growth.',
                    'tools' => 'React Native, mobile UX patterns, app prototyping, user testing, design systems, API integrations.',
                    'bestFor' => 'Consumer apps, service businesses, startups, and teams bringing an app idea to market.',
                    'useCases' => 'Booking apps, customer portals, companion apps, internal mobile tools, multi-device ecosystems.',
                ],
                [
                    'name' => 'CMS Development',
                    'desc' => 'We build elegant, easy-to-manage content systems that give teams control without sacrificing design quality. Whether you need a marketing site, ecommerce experience, or content-rich platform, we create flexible CMS setups tailored to your workflow.',
                    'tools' => 'Webflow, WordPress, Shopify, HubSpot, Squarespace, Magento, content modeling, custom templates.',
                    'bestFor' => 'Marketing teams, content-led brands, ecommerce businesses, and organizations that update content frequently.',
                    'useCases' => 'Launch sites, blogs, ecommerce storefronts, campaign pages, resource hubs, scalable content operations.',
                ],
            ] as $service)
                <x-card class="lg:p-10">
                    <div class="grid gap-8 lg:grid-cols-[1.2fr_1fr]">
                        <div>
                            <p class="text-heading-lg font-semibold text-paper">{{ $service['name'] }}</p>
                            <p class="mt-4 text-body-md text-paper-dim">{{ $service['desc'] }}</p>
                            <div class="mt-6">
                                <x-button href="{{ route('contact') }}" variant="outline">Request This Service</x-button>
                            </div>
                        </div>
                        <div class="space-y-4 border-t border-ink-700 pt-6 lg:border-l lg:border-t-0 lg:pl-8 lg:pt-0">
                            <div>
                                <p class="text-body-sm uppercase tracking-widest text-muted">Tools & Technologies</p>
                                <p class="mt-1 text-body-sm text-paper-dim">{{ $service['tools'] }}</p>
                            </div>
                            <div>
                                <p class="text-body-sm uppercase tracking-widest text-muted">Best For</p>
                                <p class="mt-1 text-body-sm text-paper-dim">{{ $service['bestFor'] }}</p>
                            </div>
                            <div>
                                <p class="text-body-sm uppercase tracking-widest text-muted">Use Cases</p>
                                <p class="mt-1 text-body-sm text-paper-dim">{{ $service['useCases'] }}</p>
                            </div>
                        </div>
                    </div>
                </x-card>
            @endforeach
        </x-container>
    </section>

    {{-- SERVICE TAG STRIP (repeated as section divider) --}}
    <section class="border-y border-ink-800 py-6">
        <x-container class="flex flex-wrap justify-center gap-3">
            @foreach (['UI/UX Design', 'Web Development', 'SaaS Product Development', 'Mobile App Design & Dev', 'CMS Development'] as $tag)
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
            @foreach (['UI/UX Design', 'Web Development', 'SaaS Product Development', 'Mobile App Design & Dev', 'CMS Development'] as $tag)
                <span class="rounded-full border border-ink-700 px-4 py-2 text-body-sm text-paper-dim">{{ $tag }}</span>
            @endforeach
        </x-container>
    </section>

    {{-- PORTFOLIO TEASER --}}
    <section class="py-24">
        <x-container>
            <div class="flex flex-wrap items-end justify-between gap-4">
                <x-section-heading eyebrow="Selected Work">Recent Case Studies</x-section-heading>
                <x-button href="{{ route('work.index') }}" variant="ghost">View All Projects</x-button>
            </div>

            <div class="mt-12 grid gap-6 md:grid-cols-3">
                @foreach ([
                    ['name' => 'SaaS Platform Redesign', 'tag' => 'SaaS Product Development'],
                    ['name' => 'E-Commerce Relaunch', 'tag' => 'Web Development'],
                    ['name' => 'Mobile Booking App', 'tag' => 'Mobile App Design & Dev'],
                ] as $project)
                    <a href="{{ route('work.index') }}" class="group block">
                        <x-placeholder-image :label="$project['name'] . ' — placeholder, real case studies land in Phase 3'" />
                        <p class="mt-4 text-heading-md font-semibold text-paper">{{ $project['name'] }}</p>
                        <p class="mt-1 text-body-sm text-paper-dim">{{ $project['tag'] }}</p>
                    </a>
                @endforeach
            </div>
        </x-container>
    </section>

    {{-- TESTIMONIAL --}}
    <section class="border-t border-ink-800 py-24">
        <x-container class="mx-auto max-w-3xl text-center">
            <x-heroicon-s-chat-bubble-left-right class="mx-auto h-8 w-8 text-lime-500" />
            <blockquote class="mt-6 text-heading-lg font-medium text-paper">
                &ldquo;Our collaboration with Studio transformed our product vision into a market-leading reality.
                Their strategic insight, meticulous design, and robust engineering delivered results far beyond
                our expectations. They truly are partners in innovation.&rdquo;
            </blockquote>
            <p class="mt-6 text-body-sm text-paper-dim">— Jane Doe, CEO of Tech Solutions Inc.</p>
        </x-container>
    </section>

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
