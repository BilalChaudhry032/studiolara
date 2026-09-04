@php($navItems = config('navigation.main'))

{{--
    x-data lives on this plain wrapper, not on <header>, because <header>
    carries `backdrop-blur` (backdrop-filter) — and per the CSS spec, a
    `filter`/`backdrop-filter` ancestor becomes the containing block for any
    `position: fixed` descendant. The mobile overlay below is `fixed`; nested
    inside the header it would size itself against the header's ~80px box
    instead of the viewport, so its content overflows visibly with no opaque
    background behind it. Keeping the overlay as a sibling of <header>
    (both under this filter-free wrapper) keeps it fixed to the viewport.
--}}
<div x-data="{ open: false }">
    <header class="sticky top-0 z-50 border-b border-ink-800/60 bg-ink-950/80 backdrop-blur">
        <x-container class="flex h-20 items-center justify-between">
            <a href="{{ route('home') }}" class="text-heading-md font-semibold tracking-tight text-paper">
                {{ config('app.name') }}
            </a>

            <nav class="hidden items-center gap-8 lg:flex" aria-label="Primary">
                @foreach ($navItems as $item)
                    <a
                        href="{{ route($item['route']) }}"
                        class="text-eyebrow uppercase tracking-widest transition-colors duration-300 {{ request()->routeIs($item['route']) ? 'text-lime-500' : 'text-paper-dim hover:text-lime-500' }}"
                    >
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="hidden lg:block">
                <x-button href="{{ route('contact') }}" variant="primary">Book a Call</x-button>
            </div>

            <button
                @click="open = true"
                class="text-paper lg:hidden"
                aria-label="Open menu"
                aria-haspopup="true"
                :aria-expanded="open"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
                </svg>
            </button>
        </x-container>
    </header>

    <div
        x-show="open"
        x-cloak
        x-transition:enter="transition ease-out-expo duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex flex-col bg-ink-950 lg:hidden"
        role="dialog"
        aria-modal="true"
        @keydown.escape.window="open = false"
    >
        <div class="flex h-20 items-center justify-between px-5">
            <span class="text-heading-md font-semibold text-paper">{{ config('app.name') }}</span>
            <button @click="open = false" class="text-paper" aria-label="Close menu">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <nav class="flex flex-1 flex-col items-start justify-center gap-6 px-8" aria-label="Mobile">
            @foreach ($navItems as $item)
                <a
                    @click="open = false"
                    href="{{ route($item['route']) }}"
                    class="text-display-md font-semibold {{ request()->routeIs($item['route']) ? 'text-lime-500' : 'text-paper hover:text-lime-500' }}"
                >
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="px-8 pb-10">
            <x-button href="{{ route('contact') }}" variant="primary" class="w-full">Book a Call</x-button>
        </div>
    </div>
</div>
