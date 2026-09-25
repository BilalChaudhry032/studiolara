{{-- Dev-only component kit (REDESIGN_PLAN.md, phase R1). Delete before launch. --}}
<x-layout title="Component kit">
    <x-container class="space-y-20 py-16">
        <x-sign as="h1" size="xl" :lines="['u', 'w', 's', 'm', 'c']">Component kit</x-sign>

        <section class="space-y-6">
            <x-sign size="md">Route bullets</x-sign>
            @foreach ($services as $service)
                <div class="flex flex-wrap items-center gap-4">
                    @foreach (['sm', 'md', 'lg', 'xl'] as $size)
                        <x-bullet :line="$service->line" :size="$size" />
                    @endforeach
                    <span class="text-heading-md font-bold stretch-semi">{{ $service->title }}</span>
                </div>
            @endforeach
        </section>

        <section class="space-y-6">
            <x-sign size="md">Sign bands</x-sign>
            <x-sign size="md" arrow="right">The line</x-sign>
            <x-sign :lines="['u', 's']" arrow="right">Pick your line</x-sign>
            <x-sign size="xl" arrow="up-right">One team. One line.</x-sign>
        </section>

        <section class="space-y-6">
            <x-sign size="md">Buttons and arrows</x-sign>
            <div class="flex flex-wrap items-center gap-6">
                <x-button href="#">Book a strategy call</x-button>
                <x-button href="#" variant="outline">See the work</x-button>
                <x-button href="#" variant="ghost">Read the process</x-button>
                <x-button href="#" size="sm">Book a call</x-button>
                <x-button disabled>Disabled</x-button>
            </div>
            <div class="flex items-center gap-6 text-display-md">
                @foreach (['right', 'left', 'up', 'down', 'up-right', 'down-right'] as $dir)
                    <x-arrow :dir="$dir" />
                @endforeach
            </div>
        </section>

        <section class="space-y-10">
            <x-sign size="md">Routes</x-sign>
            <x-route
                :stations="[
                    ['label' => 'Discover', 'note' => 'Users, business model, goals'],
                    ['label' => 'Define', 'note' => 'A focused strategy and scope'],
                    ['label' => 'Design', 'note' => 'Conversion, clarity, confidence'],
                    ['label' => 'Build', 'note' => 'Scalable, fast, stable'],
                    ['label' => 'Refine', 'note' => 'Real feedback, real data'],
                ]"
                :current="2"
                progress
            />
            <x-route line="u" size="lg" :stations="[['label' => 'Research'], ['label' => 'Wireframes'], ['label' => 'Prototype'], ['label' => 'UI']]" />
            <div class="grid gap-12 md:grid-cols-2">
                <x-route line="m" orientation="vertical" :current="1" progress :stations="[
                    ['label' => 'Booking apps', 'note' => 'Yellow line with its ink casing on day white.'],
                    ['label' => 'Customer portals'],
                    ['label' => 'Companion apps', 'note' => 'A longer note wraps under its label without breaking the line between stations.'],
                    ['label' => 'Internal tools'],
                ]" />
                <x-route orientation="vertical" size="lg" :current="0" current-type="page" :stations="[
                    ['label' => 'Home', 'href' => '#'],
                    ['label' => 'Services', 'href' => '#'],
                    ['label' => 'Work', 'href' => '#'],
                    ['label' => 'Contact', 'href' => '#'],
                ]" />
            </div>
        </section>

        <section class="space-y-6">
            <x-sign size="md">Departure board</x-sign>
            <div class="bg-panel p-4 md:p-6">
                <div class="grid grid-cols-1 gap-x-6 gap-y-3 text-[clamp(0.875rem,0.7rem+0.6vw,1.25rem)] md:grid-cols-[1fr_auto_auto]">
                    <span class="hidden text-body-sm font-semibold uppercase tracking-[0.06em] text-text-3 md:block">Service</span>
                    <span class="hidden text-body-sm font-semibold uppercase tracking-[0.06em] text-text-3 md:block">Journey time</span>
                    <span class="hidden text-body-sm font-semibold uppercase tracking-[0.06em] text-text-3 md:block">Fare</span>
                    @foreach ($plans as $plan)
                        <x-split-flap :text="$plan->tagline" :length="19" />
                        <x-split-flap class="hidden md:inline-flex" :text="$plan->timeline" :length="15" />
                        <x-split-flap :text="\Illuminate\Support\Str::of($plan->price_range)->before(' –')->before(' (')" :length="15" />
                    @endforeach
                </div>
            </div>
            <div x-data="{ i: 0, stops: ['Discover', 'Define', 'Design', 'Build', 'Refine'] }" class="flex flex-wrap items-center gap-4 text-heading-lg">
                <x-split-flap text="Discover" :length="8" watch="stops[i]" />
                <x-button variant="outline" size="sm" @click="i = (i + 1) % stops.length">Next station</x-button>
            </div>
        </section>

        <section class="space-y-6">
            <x-sign size="md">Fare tickets</x-sign>
            @foreach ($plans as $plan)
                <x-ticket :name="$plan->name" :tagline="$plan->tagline" :price="$plan->price_range" :duration="$plan->timeline" :best-for="$plan->best_for">
                    <x-slot:deliverables>
                        <ul class="mt-6 grid gap-x-8 gap-y-2 text-body-md text-text-2 sm:grid-cols-2">
                            @foreach (array_slice($plan->deliverables ?? [], 0, 6) as $item)
                                <li class="flex gap-3"><span aria-hidden="true" class="mt-2 h-2 w-2 shrink-0 rounded-full bg-text"></span>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </x-slot:deliverables>
                    <x-slot:action>
                        <x-button href="#" variant="on-sign" size="sm">Choose {{ $plan->name }}</x-button>
                    </x-slot:action>
                </x-ticket>
            @endforeach
        </section>

        <section class="space-y-6">
            <x-sign size="md">Platform posters</x-sign>
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <x-poster href="#" title="SaaS Platform Redesign" subtitle="UI/UX Design · SaaS Product Development" :lines="['u', 's']" sample />
                <x-poster href="#" title="E-Commerce Relaunch" subtitle="Web Development · CMS Development" :lines="['w', 'c']" sample />
                <x-poster href="#" title="Mobile Booking App" subtitle="Mobile App Design & Dev · UI/UX Design" :lines="['m', 'u']" sample />
            </div>
        </section>
    </x-container>
</x-layout>
