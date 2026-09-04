<x-layout
    title="Team"
    description="Meet the designers and engineers behind the work — a small, senior team that treats every project as a partnership."
>
    <section class="py-24 lg:py-32">
        <x-container class="mx-auto max-w-3xl text-center">
            <p class="text-eyebrow uppercase tracking-widest text-lime-500">Our Team</p>
            <h1 class="mt-4 text-display-lg font-semibold text-paper">
                A Small, Senior Team — Not a Revolving Door of Juniors
            </h1>
            <p class="mt-6 text-body-lg text-paper-dim">
                Every project is led by the same senior designers and engineers from discovery through launch —
                embedded as a true extension of your team, not handed off between departments.
            </p>
        </x-container>
    </section>

    {{--
        Placeholder roster: the SRS doc calls for "team member profiles with
        photos, roles, expertise, social links, and bios" but names no real
        people. These are structural placeholders (clearly generic, not
        fabricated as if real) until real team info + photos are provided —
        Phase 3 makes this a Filament-managed `team_members` resource.
    --}}
    <section class="border-t border-ink-800 py-24">
        <x-container>
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ([
                    ['role' => 'Creative Director', 'expertise' => 'Brand & Product Design'],
                    ['role' => 'Head of Engineering', 'expertise' => 'Web & SaaS Architecture'],
                    ['role' => 'Lead Product Designer', 'expertise' => 'UX Strategy & Prototyping'],
                    ['role' => 'Senior Frontend Engineer', 'expertise' => 'Performance & Accessibility'],
                    ['role' => 'Mobile Engineering Lead', 'expertise' => 'iOS & Android'],
                    ['role' => 'Client Partnerships Lead', 'expertise' => 'Discovery & Strategy'],
                ] as $member)
                    <x-card>
                        <x-placeholder-image label="Team photo" ratio="aspect-square" />
                        <p class="mt-4 text-heading-md font-semibold text-paper">Team Member</p>
                        <p class="text-body-sm text-lime-500">{{ $member['role'] }}</p>
                        <p class="mt-2 text-body-sm text-paper-dim">{{ $member['expertise'] }}</p>
                    </x-card>
                @endforeach
            </div>

            <p class="mt-8 text-center text-body-sm text-muted">
                Real names, roles, photos, and bios land here once provided — see PROJECT_PLAN_AND_PROGRESS.md.
            </p>
        </x-container>
    </section>

    {{-- CULTURE / VALUES (reuses core values from About) --}}
    <section class="border-t border-ink-800 py-24">
        <x-container>
            <x-section-heading eyebrow="How We Work" align="center" class="mx-auto">
                Why Clients Trust Our Team
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
        </x-container>
    </section>

    {{-- FOOTER CTA --}}
    <section class="border-t border-ink-800 py-24">
        <x-container class="mx-auto max-w-2xl text-center">
            <h2 class="text-display-md font-semibold text-paper">Let's Build Something Great Together</h2>
            <p class="mt-4 text-body-lg text-paper-dim">
                Ready to work with a senior team that treats your project like a partnership?
            </p>
            <div class="mt-8">
                <x-button href="{{ route('contact') }}" variant="primary">Book Your Free Strategy Call Today</x-button>
            </div>
        </x-container>
    </section>
</x-layout>
