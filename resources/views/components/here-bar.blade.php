{{--
    Phones only: while a section marked data-station holds the middle of the
    screen (resources/js/journey.js), this bar names it and keeps the call to
    action in reach. It is visual wayfinding; screen readers already have the
    page's headings, so the changing name is not announced.
--}}
<div
    x-data="{ here: null }"
    @station.window="here = $event.detail"
    x-show="here"
    x-cloak
    x-transition:enter="transition duration-300 ease-out-expo"
    x-transition:enter-start="translate-y-full"
    x-transition:enter-end="translate-y-0"
    x-transition:leave="transition duration-150 ease-in"
    x-transition:leave-start="translate-y-0"
    x-transition:leave-end="translate-y-full"
    class="fixed inset-x-0 bottom-0 z-30 border-t border-rule bg-ground lg:hidden"
>
    <div class="flex items-center gap-3 px-5 py-2.5 sm:px-8">
        <div class="min-w-0 flex-1" aria-hidden="true">
            <p class="text-[0.6875rem] font-semibold uppercase tracking-[0.06em] text-text-3">You are here</p>
            <x-split-flap text="" :length="17" watch="here ?? ''" class="mt-1 text-[0.8125rem]" />
        </div>
        <x-button :href="route('contact')" size="sm">Book a call</x-button>
    </div>
</div>
