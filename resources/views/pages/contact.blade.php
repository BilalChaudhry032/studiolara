<x-layout
    title="Contact"
    description="Ready to turn your idea into a digital product? Get in touch, or book a free 30-minute strategy call."
>
    {{-- HERO --}}
    <section class="py-24 lg:py-32">
        <x-container class="mx-auto max-w-3xl text-center">
            <p class="text-eyebrow uppercase tracking-widest text-lime-500">Contact Us</p>
            <h1 class="mt-4 text-display-lg font-semibold text-paper">
                Let's Build Something Great Together
            </h1>
            <p class="mt-6 text-body-lg text-paper-dim">
                Ready to turn your idea into a digital product? Get in touch with our team today — we're here to
                listen, strategize, and bring your vision to life.
            </p>
        </x-container>
    </section>

    {{-- FORM + CALENDLY PANEL --}}
    <section class="border-t border-ink-800 py-24">
        <x-container class="grid gap-8 lg:grid-cols-[1.4fr_1fr]">
            {{-- Real contact form — wired to Mail + DB storage + spam protection in Phase 5 --}}
            <x-card class="lg:p-10">
                <p class="text-heading-lg font-semibold text-paper">Send Us a Message</p>
                <p class="mt-2 text-body-sm text-paper-dim">
                    Use the form below to tell us more about your project. We'll get back to you within 24 hours.
                </p>

                <form method="POST" action="{{ route('contact') }}" class="mt-8 space-y-6">
                    @csrf
                    {{-- Honeypot field, wired in Phase 5 --}}
                    <input type="text" name="website" tabindex="-1" autocomplete="off" class="hidden" aria-hidden="true">

                    <div class="grid gap-6 sm:grid-cols-2">
                        <div>
                            <label for="name" class="text-body-sm text-paper-dim">Name</label>
                            <input type="text" id="name" name="name" required
                                class="mt-2 w-full rounded-lg border border-ink-700 bg-ink-950 px-4 py-3 text-body-md text-paper focus-visible:border-lime-500">
                        </div>
                        <div>
                            <label for="email" class="text-body-sm text-paper-dim">Email</label>
                            <input type="email" id="email" name="email" required
                                class="mt-2 w-full rounded-lg border border-ink-700 bg-ink-950 px-4 py-3 text-body-md text-paper focus-visible:border-lime-500">
                        </div>
                    </div>

                    <div>
                        <label for="company" class="text-body-sm text-paper-dim">Company / Project Name</label>
                        <input type="text" id="company" name="company"
                            class="mt-2 w-full rounded-lg border border-ink-700 bg-ink-950 px-4 py-3 text-body-md text-paper focus-visible:border-lime-500">
                    </div>

                    <div class="grid gap-6 sm:grid-cols-3">
                        <div>
                            <label for="project_type" class="text-body-sm text-paper-dim">Project Type</label>
                            <select id="project_type" name="project_type"
                                class="mt-2 w-full rounded-lg border border-ink-700 bg-ink-950 px-4 py-3 text-body-md text-paper focus-visible:border-lime-500">
                                <option>Website</option>
                                <option>SaaS</option>
                                <option>Mobile App</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div>
                            <label for="budget_range" class="text-body-sm text-paper-dim">Budget Range</label>
                            <select id="budget_range" name="budget_range"
                                class="mt-2 w-full rounded-lg border border-ink-700 bg-ink-950 px-4 py-3 text-body-md text-paper focus-visible:border-lime-500">
                                <option>Under $5K</option>
                                <option>$5K–$15K</option>
                                <option>$15K–$50K</option>
                                <option>$50K+</option>
                            </select>
                        </div>
                        <div>
                            <label for="timeline" class="text-body-sm text-paper-dim">Timeline</label>
                            <select id="timeline" name="timeline"
                                class="mt-2 w-full rounded-lg border border-ink-700 bg-ink-950 px-4 py-3 text-body-md text-paper focus-visible:border-lime-500">
                                <option>ASAP</option>
                                <option>1–3 months</option>
                                <option>3–6 months</option>
                                <option>6+ months</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="description" class="text-body-sm text-paper-dim">Project Description</label>
                        <textarea id="description" name="description" rows="4" required
                            class="mt-2 w-full rounded-lg border border-ink-700 bg-ink-950 px-4 py-3 text-body-md text-paper focus-visible:border-lime-500"
                            placeholder="Tell us about your idea"></textarea>
                    </div>

                    <x-button class="w-full">Send Message</x-button>
                    <p class="text-center text-body-sm text-muted">We respect your privacy. Your information is secure.</p>
                </form>
            </x-card>

            <div class="space-y-8">
                {{-- Calendly link-out (matches tapline.studio's pattern — a button linking out, not an embed) --}}
                <x-card>
                    <p class="text-heading-md font-semibold text-paper">Prefer Talking It Through?</p>
                    <p class="mt-2 text-body-sm text-paper-dim">
                        Book a 30-minute call with our team to discuss your project, goals, and how we can help.
                        Our calendar displays available times in your local timezone.
                    </p>
                    <x-button href="https://calendly.com/your-agency/strategy-call" variant="outline" class="mt-6 w-full">
                        Book a Call on Calendly
                    </x-button>
                </x-card>

                <x-card>
                    <p class="text-heading-md font-semibold text-paper">Dedicated Support</p>
                    <p class="mt-2 text-body-sm text-paper-dim">Phone: +1 (555) 123-4567</p>
                </x-card>

                <x-card>
                    <p class="text-heading-md font-semibold text-paper">Simple & Transparent Billing</p>
                    <p class="mt-2 text-body-sm text-paper-dim">Email: contact@agency.com</p>
                </x-card>

                <x-card>
                    <p class="text-heading-md font-semibold text-paper">Join Our Team</p>
                    <p class="mt-2 text-body-sm text-paper-dim">Open to collaborating with great talent.</p>
                    <a href="mailto:careers@agency.com" class="mt-3 inline-block text-body-sm text-lime-500 hover:underline">
                        Submit Your Resume →
                    </a>
                </x-card>
            </div>
        </x-container>
    </section>

    {{-- WHAT TO EXPECT --}}
    <section class="border-t border-ink-800 py-24">
        <x-container>
            <x-section-heading eyebrow="What Happens Next" align="center" class="mx-auto">
                What to Expect After You Reach Out
            </x-section-heading>

            <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ([
                    ['step' => '01', 'name' => 'Initial Consultation', 'blurb' => 'A 30-minute call to understand your goals, vision, and project requirements.'],
                    ['step' => '02', 'name' => 'Project Scoping', 'blurb' => 'We define scope, estimate timelines, and discuss investment — typically within 1–2 weeks.'],
                    ['step' => '03', 'name' => 'Proposal & Agreement', 'blurb' => 'Review our detailed proposal, refine any aspects, and finalize the agreement (usually 1 week).'],
                    ['step' => '04', 'name' => 'Kick-off & Execution', 'blurb' => 'We kick off the project, maintaining regular communication and transparency throughout.'],
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

    {{-- SERVICE TAG STRIP --}}
    <section class="border-y border-ink-800 py-6">
        <x-marquee speed="22">
            @foreach (['UI/UX Design', 'Web Development', 'SaaS Product Development', 'Mobile App Design & Dev', 'CMS Development'] as $tag)
                <span class="rounded-full border border-ink-700 px-4 py-2 text-body-sm text-paper-dim">{{ $tag }}</span>
            @endforeach
        </x-marquee>
    </section>
</x-layout>
