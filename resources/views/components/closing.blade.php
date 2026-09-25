@props([
    'stop' => false, // show the spine's station marker (pages with a spine)
])

{{-- The end of every ride: plan the journey or book a call. --}}
<section data-station="Plan your journey" {{ $attributes->merge(['class' => 'pb-24 pt-16 md:pb-32 md:pt-28']) }}>
    <x-container>
        <div class="relative">
            @if ($stop)
                <span data-stop aria-hidden="true" class="absolute left-[-37px] top-1/2 hidden h-[26px] w-[26px] -translate-y-1/2 rounded-full border-4 border-text bg-ground transition-colors duration-150 [&.is-passed]:bg-text lg:block"></span>
            @endif
            <x-sign size="xl" arrow="right">Plan your journey</x-sign>
        </div>
        <div class="mt-10 grid gap-8 lg:grid-cols-12 lg:items-end">
            <p class="max-w-[40ch] text-heading-lg font-semibold stretch-semi lg:col-span-7">
                {{ $slot->isEmpty() ? "Tell us where you are and where you want to go, and we'll plan the route with you." : $slot }}
            </p>
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:gap-6 lg:col-span-5 lg:justify-end">
                <x-button :href="route('contact')">Book a strategy call</x-button>
                <x-button href="mailto:{{ config('studio.email') }}" variant="ghost" class="self-start sm:self-auto">{{ config('studio.email') }}</x-button>
            </div>
        </div>
    </x-container>
</section>
