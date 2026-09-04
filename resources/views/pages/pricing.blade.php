<x-layout
    title="Pricing"
    description="Simple, transparent pricing from MVP validation to enterprise-scale systems — Starter, Growth, and Scale plans."
>
    {{-- HERO --}}
    <section class="py-24 lg:py-32">
        <x-container class="mx-auto max-w-3xl text-center">
            <p class="text-eyebrow uppercase tracking-widest text-lime-500">Pricing</p>
            <h1 class="mt-4 text-display-lg font-semibold text-paper">
                Simple, Transparent Pricing That Meets You Where You Are
            </h1>
            <p class="mt-6 text-body-lg text-paper-dim">
                From MVP validation to enterprise-scale systems. All plans include product strategy, UI/UX design,
                and development support.
            </p>
        </x-container>
    </section>

    {{-- PRICING TIERS --}}
    <section class="border-t border-ink-800 py-24">
        <x-container class="grid gap-8 lg:grid-cols-3">
            {{-- Starter --}}
            <x-card class="flex flex-col">
                <p class="text-body-sm uppercase tracking-widest text-muted">Starter Plan</p>
                <p class="mt-2 text-heading-lg font-semibold text-paper">MVP Launch</p>
                <p class="mt-4 text-display-md font-semibold text-lime-500">$2K–$7.5K</p>
                <p class="text-body-sm text-paper-dim">Timeline: 3–8 weeks</p>
                <p class="mt-4 text-body-sm text-paper-dim">Best for startups &amp; founders validating an idea.</p>
                <ul class="mt-6 flex-1 space-y-3">
                    @foreach ([
                        'Product discovery & strategy session',
                        'UX wireframes + UI design (8–12 screens)',
                        'Website design & development (4–10 pages)',
                        'Responsive design for all devices',
                        'CMS setup (Webflow, WordPress, or Shopify) or basic custom frontend',
                        'Basic SEO optimization',
                        'Contact forms & email integration',
                        '2 revision cycles',
                        'Deployment & launch support',
                        '30 days post-launch support',
                    ] as $item)
                        <li class="flex items-start gap-3 text-body-sm text-paper-dim">
                            <x-heroicon-o-check class="mt-0.5 h-4 w-4 shrink-0 text-lime-500" />
                            {{ $item }}
                        </li>
                    @endforeach
                </ul>
                <x-button href="{{ route('contact') }}" variant="outline" class="mt-8 w-full">Start a Project</x-button>
            </x-card>

            {{-- Growth (featured) --}}
            <x-card class="flex flex-col border-lime-500">
                <p class="text-body-sm uppercase tracking-widest text-lime-500">Growth Plan</p>
                <p class="mt-2 text-heading-lg font-semibold text-paper">Full Product Build</p>
                <p class="mt-4 text-display-md font-semibold text-lime-500">$7K–$20K</p>
                <p class="text-body-sm text-paper-dim">Timeline: 3–6 months</p>
                <p class="mt-4 text-body-sm text-paper-dim">Best for SaaS startups &amp; growing businesses ready to scale.</p>
                <ul class="mt-6 flex-1 space-y-3">
                    @foreach ([
                        'Complete product strategy & user flows',
                        'Full UI/UX design system (50+ screens)',
                        'Website design & development (10–25 pages)',
                        'Full-stack development with custom backend',
                        'Database architecture & API design',
                        'User authentication & admin dashboard',
                        'Advanced CMS integration or custom development',
                        'Payment processing integration',
                        'Email automation & notifications',
                        'Analytics & conversion tracking',
                        '3 revision cycles',
                        'Performance optimization & SEO',
                        '60 days post-launch support & bug fixes',
                    ] as $item)
                        <li class="flex items-start gap-3 text-body-sm text-paper-dim">
                            <x-heroicon-o-check class="mt-0.5 h-4 w-4 shrink-0 text-lime-500" />
                            {{ $item }}
                        </li>
                    @endforeach
                </ul>
                <x-button href="{{ route('contact') }}" variant="primary" class="mt-8 w-full">Start a Project</x-button>
            </x-card>

            {{-- Scale --}}
            <x-card class="flex flex-col">
                <p class="text-body-sm uppercase tracking-widest text-muted">Scale Plan</p>
                <p class="mt-2 text-heading-lg font-semibold text-paper">Enterprise Solution</p>
                <p class="mt-4 text-display-md font-semibold text-lime-500">$25K+</p>
                <p class="text-body-sm text-paper-dim">Timeline: 6–12+ months</p>
                <p class="mt-4 text-body-sm text-paper-dim">Best for established companies &amp; complex enterprise systems.</p>
                <ul class="mt-6 flex-1 space-y-3">
                    @foreach ([
                        'Dedicated product & development team',
                        'Advanced product architecture & strategy',
                        'Enterprise-grade design system',
                        'Multi-tenant SaaS platform development',
                        'Complex database architecture',
                        'Advanced security & compliance features',
                        'AI/ML integrations & automation',
                        'Third-party integrations (CRM, ERP, analytics)',
                        'Custom admin & reporting dashboards',
                        'Load testing & performance optimization',
                        'Unlimited revisions during development',
                        'Priority communication & dedicated account manager',
                    ] as $item)
                        <li class="flex items-start gap-3 text-body-sm text-paper-dim">
                            <x-heroicon-o-check class="mt-0.5 h-4 w-4 shrink-0 text-lime-500" />
                            {{ $item }}
                        </li>
                    @endforeach
                </ul>
                <x-button href="{{ route('contact') }}" variant="outline" class="mt-8 w-full">Talk to Us</x-button>
            </x-card>
        </x-container>

        <p class="mx-auto mt-10 max-w-3xl text-center text-body-sm text-paper-dim">
            Timeline and pricing vary based on complexity, number of features, integrations required, total page
            count, database needs, and the level of customization involved. More moving parts typically mean a
            longer timeline and higher investment.
        </p>
    </section>

    {{-- FAQ --}}
    <section class="border-t border-ink-800 py-24">
        <x-container class="mx-auto max-w-3xl">
            <x-section-heading eyebrow="FAQ" align="center" class="mx-auto">
                Pricing Questions
            </x-section-heading>

            <div x-data="{ open: null }" class="mt-12 divide-y divide-ink-800">
                @foreach ([
                    ['q' => 'Which plan is right for me?', 'a' => 'Starter suits founders validating an idea with a lean MVP. Growth suits SaaS startups and growing businesses ready for a full product build. Scale suits established companies with complex, enterprise-grade requirements.'],
                    ['q' => 'What affects the final price within a range?', 'a' => 'Number of features, integrations needed, database complexity, and user roles & permissions all affect where a project lands within its tier\'s range.'],
                    ['q' => 'Can I move between plans mid-project?', 'a' => 'Yes — scope can evolve as we learn more together. We\'ll re-scope and adjust timeline/investment transparently if requirements grow beyond the original plan.'],
                    ['q' => 'Is ongoing support included?', 'a' => 'Starter includes 30 days post-launch support, Growth includes 60 days plus bug fixes, and Scale includes ongoing support and maintenance with a dedicated account manager.'],
                ] as $index => $faq)
                    <div class="py-6">
                        <button
                            type="button"
                            @click="open = open === {{ $index }} ? null : {{ $index }}"
                            class="flex w-full items-center justify-between gap-4 text-left"
                            :aria-expanded="open === {{ $index }}"
                        >
                            <span class="text-heading-md font-semibold text-paper">{{ $faq['q'] }}</span>
                            <x-heroicon-o-chevron-down
                                class="h-5 w-5 shrink-0 text-lime-500 transition-transform duration-300"
                                x-bind:class="open === {{ $index }} ? 'rotate-180' : ''"
                            />
                        </button>
                        <div x-show="open === {{ $index }}" x-cloak x-collapse class="mt-4 text-body-md text-paper-dim">
                            {{ $faq['a'] }}
                        </div>
                    </div>
                @endforeach
            </div>
        </x-container>
    </section>

    {{-- FOOTER CTA --}}
    <section class="border-t border-ink-800 py-24">
        <x-container class="mx-auto max-w-2xl text-center">
            <h2 class="text-display-md font-semibold text-paper">Not Sure Which Plan Fits?</h2>
            <p class="mt-4 text-body-lg text-paper-dim">
                Book a free strategy call and we'll help you figure out the right scope and investment.
            </p>
            <div class="mt-8">
                <x-button href="{{ route('contact') }}" variant="primary">Book Your Free Strategy Call Today</x-button>
            </div>
        </x-container>
    </section>
</x-layout>
