@php
    $items = config('navigation.main');
    $stations = array_map(fn ($item) => ['label' => $item['label'], 'href' => route($item['route'])], $items);

    // A section's detail pages (services.show, work.show, blog.show) keep its station lit.
    $current = collect($items)->search(fn ($item) => request()->routeIs(\Illuminate\Support\Str::before($item['route'], '.') . '*'));
    $current = $current === false ? null : $current;
@endphp

{{--
    x-data sits on this plain wrapper, not on <header>, so the fixed mobile
    menu is the header's sibling rather than its child. While the menu is
    open, everything behind it is made inert: focus cannot leave the menu,
    and screen readers only see the menu.
--}}
<div
    x-data="{
        open: false,
        toggle(state) {
            this.open = state;
            document.documentElement.classList.toggle('overflow-hidden', state);
            [...document.body.children].forEach((el) => { if (el !== this.$root) el.inert = state; });
            this.$refs.header.inert = state;
            this.$nextTick(() => (state ? this.$refs.close : this.$refs.menu).focus());
        },
    }"
    @keydown.escape.window="open && toggle(false)"
>
    <header x-ref="header" class="sticky top-0 z-40 border-b border-rule bg-ground">
        <x-container class="flex h-20 items-center gap-8">
            <x-wordmark />

            <nav aria-label="Primary" class="hidden flex-1 lg:block">
                <x-route :stations="$stations" :current="$current" current-type="page" size="sm" />
            </nav>

            <div class="hidden items-center gap-5 lg:flex">
                <x-theme-toggle />
                <x-button href="{{ route('contact') }}" size="sm">Book a call</x-button>
            </div>

            <button
                x-ref="menu"
                type="button"
                @click="toggle(true)"
                class="ml-auto inline-flex min-h-11 items-center gap-2 text-body-md font-semibold stretch-semi lg:hidden"
                aria-haspopup="dialog"
                :aria-expanded="open"
            >
                Menu
                <x-heroicon-o-bars-3 class="h-6 w-6" aria-hidden="true" />
            </button>
        </x-container>
    </header>

    <div
        x-show="open"
        x-cloak
        x-transition:enter="transition ease-out-expo duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex flex-col overflow-y-auto bg-ground lg:hidden"
        role="dialog"
        aria-modal="true"
        aria-label="Menu"
    >
        <div class="flex h-20 shrink-0 items-center justify-between border-b border-rule px-5 sm:px-8">
            <x-wordmark />
            <button
                x-ref="close"
                type="button"
                @click="toggle(false)"
                class="inline-flex min-h-11 items-center gap-2 text-body-md font-semibold stretch-semi"
            >
                Close
                <x-heroicon-o-x-mark class="h-6 w-6" aria-hidden="true" />
            </button>
        </div>

        <nav aria-label="Primary" class="flex-1 px-6 py-8 sm:px-10">
            <x-route :stations="$stations" :current="$current" current-type="page" orientation="vertical" size="lg" />
        </nav>

        <div class="space-y-4 px-6 pb-8 sm:px-10">
            <x-button href="{{ route('contact') }}" class="w-full">Book a call</x-button>
            <x-theme-toggle />
        </div>
    </div>
</div>
