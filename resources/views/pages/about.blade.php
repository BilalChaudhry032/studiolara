<x-layout
    title="About"
    description="Born from a shared vision of transforming ambitious ideas into impactful digital realities — meet the studio behind the work."
>
    {{-- HERO --}}
    <section class="py-24 lg:py-32">
        <x-container class="grid gap-12 lg:grid-cols-2 lg:items-center">
            <div>
                <p class="text-eyebrow uppercase tracking-widest text-lime-500">About Us</p>
                <h1 class="mt-4 text-display-lg font-semibold text-paper">
                    Our Story: Forging Digital Futures
                </h1>
                <p class="mt-6 text-body-lg text-paper-dim">
                    Born from a shared vision of transforming ambitious ideas into impactful digital realities,
                    our studio was founded over eight years ago by a collective of seasoned designers and engineers.
                    We recognized a critical gap in the market: an abundance of development shops focused solely on
                    features, yet a scarcity of partners dedicated to building products that truly matter.
                </p>
            </div>
            <x-placeholder-image label="Studio / team photo" ratio="aspect-square" />
        </x-container>
    </section>

    {{-- CLIENT LOGOS MARQUEE --}}
    <section class="border-y border-ink-800 py-12">
        <x-marquee speed="28">
            @for ($i = 1; $i <= 6; $i++)
                <x-placeholder-image label="Client logo" ratio="aspect-[3/1]" class="w-48" />
            @endfor
        </x-marquee>
    </section>

    {{-- NARRATIVE + TRAIT CALLOUTS --}}
    <section class="py-24">
        <x-container class="grid gap-16 lg:grid-cols-2">
            <div>
                <x-section-heading eyebrow="Mission & Vision">
                    We Help Ambitious Companies Build Digital Products That Matter
                </x-section-heading>
                <p class="mt-6 text-body-md text-paper-dim">
                    Our mission is clear: we are dedicated to transforming visionary ideas into tangible,
                    market-leading solutions that drive real business growth and user engagement. Our vision is
                    to be the trusted design and development partner for founders and growth-stage teams — the
                    catalyst that elevates nascent concepts into category-defining products.
                </p>
                <div class="mt-8 flex flex-wrap gap-4">
                    <x-button href="{{ route('services.index') }}" variant="outline">Explore Services</x-button>
                    <x-button href="{{ route('contact') }}" variant="ghost">Contact Us</x-button>
                </div>
            </div>

            <div class="grid gap-6 sm:grid-cols-2">
                <x-card>
                    <p class="text-heading-md font-semibold text-lime-500">Business-Driven</p>
                    <p class="mt-2 text-body-sm text-paper-dim">
                        We identify the opportunities that improve conversion, strengthen positioning, and support growth — not just execute requests.
                    </p>
                </x-card>
                <x-card>
                    <p class="text-heading-md font-semibold text-lime-500">Built for Scale</p>
                    <p class="mt-2 text-body-sm text-paper-dim">
                        Clean, maintainable foundations that evolve as your product, content, and team expand.
                    </p>
                </x-card>
            </div>
        </x-container>
    </section>

    {{-- WHY BRANDS CHOOSE US — 4-card grid (core values) --}}
    <section class="border-t border-ink-800 py-24">
        <x-container>
            <x-section-heading eyebrow="What Drives Us" align="center" class="mx-auto">
                The Pillars of Our Work
            </x-section-heading>

            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ([
                    ['name' => 'Quality', 'blurb' => 'Pixel-perfect designs and robust, clean code that stands the test of time.'],
                    ['name' => 'Strategy', 'blurb' => 'Every decision rooted in a deep understanding of your business goals and market.'],
                    ['name' => 'Collaboration', 'blurb' => 'We partner closely with you, embedding our team as an extension of your own.'],
                    ['name' => 'Impact', 'blurb' => 'We focus on outcomes, ensuring our solutions drive measurable business growth.'],
                ] as $value)
                    <x-card>
                        <p class="text-heading-md font-semibold text-paper">{{ $value['name'] }}</p>
                        <p class="mt-2 text-body-sm text-paper-dim">{{ $value['blurb'] }}</p>
                    </x-card>
                @endforeach
            </div>

            <p class="mx-auto mt-8 max-w-2xl text-center text-body-sm text-paper-dim">
                Above all, we embrace cutting-edge technologies and creative problem-solving to stay ahead —
                innovation is the thread that runs through everything listed above.
            </p>
        </x-container>
    </section>

    {{-- STATS + CTA --}}
    <section class="border-t border-ink-800 py-24">
        <x-container class="text-center">
            <x-section-heading eyebrow="Our Track Record" align="center" class="mx-auto">
                We Deliver Results That Speak for Themselves
            </x-section-heading>

            <div class="mx-auto mt-12 grid max-w-2xl grid-cols-3 gap-6">
                <x-stat-counter :target="150" suffix="+" label="Projects Delivered" />
                <x-stat-counter :target="8" suffix="+" label="Years in Business" />
                <x-stat-counter :target="40" suffix="%" label="Avg. Conversion Lift" />
            </div>

            <div class="mt-10">
                <x-button href="{{ route('contact') }}" variant="primary">Let's Talk</x-button>
            </div>
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

    {{-- FAQ ACCORDION --}}
    <section class="border-t border-ink-800 py-24">
        <x-container class="mx-auto max-w-3xl">
            <x-section-heading eyebrow="FAQ" align="center" class="mx-auto">
                Frequently Asked Questions
            </x-section-heading>

            <div x-data="{ open: null }" class="mt-12 divide-y divide-ink-800">
                @foreach ([
                    ['q' => 'What does it cost to work with you?', 'a' => 'Our Starter plan runs $2,000–$7,500, Growth runs $7,000–$20,000, and Scale is custom-quoted from $25,000+. Exact pricing depends on scope, features, and timeline — see the Pricing page for full detail.'],
                    ['q' => 'What makes you different from other agencies?', 'a' => 'We focus on outcomes, not just deliverables — every engagement blends product strategy, conversion-focused design, and scalable engineering rather than treating design and development as separate handoffs.'],
                    ['q' => 'What does onboarding look like?', 'a' => 'After an initial 30-minute consultation, we scope the project and estimate timelines (typically 1–2 weeks), then share a detailed proposal before kicking off work.'],
                    ['q' => 'Do you offer ongoing support after launch?', 'a' => 'Yes. Starter includes 30 days of post-launch support, Growth includes 60 days plus bug fixes, and Scale includes ongoing support and maintenance with a dedicated account manager.'],
                    ['q' => 'What do you need from me to get started?', 'a' => 'Just a clear sense of your goals and any existing brand/product materials you have. We handle discovery, strategy, and scoping together in our first working sessions.'],
                    ['q' => 'Do you work with international clients?', 'a' => 'Yes — we regularly work with founders and teams across the US and EU, with calls scheduled in your local timezone via Calendly.'],
                    ['q' => 'How long does a typical project take?', 'a' => 'A Starter MVP typically takes 3–8 weeks. A full Growth-tier product build runs 3–6 months. Scale-tier enterprise engagements run 6–12+ months depending on scope.'],
                    ['q' => 'Can I edit the website myself after launch?', 'a' => 'Yes — content (case studies, services, team, blog, pricing) is managed through an admin panel, so you can update copy and media without touching code.'],
                ] as $index => $faq)
                    <div class="py-6" data-reveal>
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

            <p class="mt-8 text-body-sm text-muted">
                FAQ answers above are drafted from our own process/pricing details for a working first pass —
                worth a review pass before this goes live.
            </p>
        </x-container>
    </section>
</x-layout>
