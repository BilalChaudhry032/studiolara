<x-layout title="Home">
    {{--
        Temporary Phase 1 preview: this is a living style guide so the design
        system (type scale, color tokens, buttons, cards) can be reviewed
        before Phase 2 replaces this with the real homepage section-by-section
        build (hero, marquee, services grid, process, stats, portfolio,
        testimonials, footer CTA per PROJECT_PLAN_AND_PROGRESS.md §1).
    --}}

    <x-container class="py-24">
        <p class="text-eyebrow uppercase tracking-widest text-lime-500">Phase 1 — Design System Preview</p>
        <h1 class="mt-4 text-display-xl font-semibold text-paper">
            We Design & Build Digital Products That Actually Grow Businesses
        </h1>
        <p class="mt-6 max-w-2xl text-body-lg text-paper-dim">
            This is a temporary preview of the type scale, color tokens, and base
            components — not the real homepage. Phase 2 replaces this with the
            full section-by-section build.
        </p>

        <div class="mt-8 flex flex-wrap gap-4">
            <x-button href="{{ route('contact') }}" variant="primary">Book Your Free Strategy Call Today</x-button>
            <x-button href="{{ route('work.index') }}" variant="outline">See Case Studies & Recent Work</x-button>
            <x-button variant="ghost">Ghost action</x-button>
        </div>
    </x-container>

    <x-container class="space-y-16 pb-24">
        <section>
            <p class="mb-6 text-eyebrow uppercase tracking-widest text-muted">Type scale</p>
            <div class="space-y-4">
                <p class="text-display-xl font-semibold text-paper">Display XL</p>
                <p class="text-display-lg font-semibold text-paper">Display LG</p>
                <p class="text-display-md font-semibold text-paper">Display MD</p>
                <p class="text-heading-lg font-semibold text-paper">Heading LG</p>
                <p class="text-heading-md font-semibold text-paper">Heading MD</p>
                <p class="text-body-lg text-paper-dim">Body LG — the quick brown fox jumps over the lazy dog.</p>
                <p class="text-body-md text-paper-dim">Body MD — the quick brown fox jumps over the lazy dog.</p>
                <p class="text-body-sm text-paper-dim">Body SM — the quick brown fox jumps over the lazy dog.</p>
                <p class="text-eyebrow uppercase tracking-widest text-lime-500">Eyebrow label</p>
            </div>
        </section>

        <section>
            <p class="mb-6 text-eyebrow uppercase tracking-widest text-muted">Color tokens</p>
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
                <div class="space-y-2">
                    <div class="h-16 rounded-xl bg-ink-950 ring-1 ring-ink-700"></div>
                    <p class="text-body-sm text-paper-dim">ink-950</p>
                </div>
                <div class="space-y-2">
                    <div class="h-16 rounded-xl bg-ink-900"></div>
                    <p class="text-body-sm text-paper-dim">ink-900</p>
                </div>
                <div class="space-y-2">
                    <div class="h-16 rounded-xl bg-lime-500"></div>
                    <p class="text-body-sm text-paper-dim">lime-500 (accent)</p>
                </div>
                <div class="space-y-2">
                    <div class="h-16 rounded-xl bg-paper"></div>
                    <p class="text-body-sm text-paper-dim">paper</p>
                </div>
            </div>
        </section>

        <section>
            <p class="mb-6 text-eyebrow uppercase tracking-widest text-muted">Section heading component</p>
            <x-section-heading
                eyebrow="Our Approach"
                subtext="Every section is structured to build trust, communicate value, and guide visitors toward a booking action."
            >
                Not Just Design. Not Just Development.
            </x-section-heading>
        </section>

        <section>
            <p class="mb-6 text-eyebrow uppercase tracking-widest text-muted">Card component</p>
            <div class="grid gap-6 sm:grid-cols-3">
                <x-card>
                    <p class="text-heading-md font-semibold text-paper">Brand Clarity</p>
                    <p class="mt-2 text-body-sm text-paper-dim">Sharpen positioning and messaging so the right clients self-select.</p>
                </x-card>
                <x-card>
                    <p class="text-heading-md font-semibold text-paper">Growth Momentum</p>
                    <p class="mt-2 text-body-sm text-paper-dim">Design and build that compounds — faster launches, less rework.</p>
                </x-card>
                <x-card>
                    <p class="text-heading-md font-semibold text-paper">Measurable Results</p>
                    <p class="mt-2 text-body-sm text-paper-dim">Every decision tracked against real conversion and engagement data.</p>
                </x-card>
            </div>
        </section>
    </x-container>
</x-layout>
