@php
    $items = config('navigation.main');
    $services = \App\Models\Service::query()->whereNotNull('line')->orderBy('sort_order')->get(['title', 'slug', 'line']);
    $link = 'underline decoration-transparent decoration-2 underline-offset-[0.3em] transition-colors duration-150 group-hover:decoration-current hover:decoration-current';
@endphp

<footer class="bg-ground">
    <x-container class="pb-12 pt-16 md:pt-20">
        {{-- The trunk line runs out here and stops at a terminus bar. --}}
        <div aria-hidden="true" class="flex items-center gap-4">
            <span class="h-2 flex-1 bg-text"></span>
            <span class="h-8 w-2 bg-text"></span>
            <span class="text-body-sm font-semibold uppercase tracking-[0.06em] stretch-condensed">End of line</span>
        </div>

        <div class="mt-14 grid gap-12 md:grid-cols-2 lg:grid-cols-12">
            <div class="lg:col-span-5">
                <x-wordmark />
                <p class="mt-5 max-w-sm text-body-lg text-text-2">
                    One team, one line: strategy, product design and engineering, from idea to launch.
                </p>
                <x-button href="{{ route('contact') }}" class="mt-8">Book a strategy call</x-button>
            </div>

            <div class="lg:col-span-3">
                <h2 class="text-body-sm font-semibold uppercase tracking-[0.06em] text-text-3">Lines</h2>
                <ul class="mt-4 space-y-1">
                    @foreach ($services as $service)
                        <li>
                            <a href="{{ route('services.show', $service->slug) }}" class="group flex min-h-11 items-center gap-3">
                                <x-bullet :line="$service->line" size="sm" />
                                <span class="font-semibold {{ $link }}">{{ $service->title }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="lg:col-span-2">
                <h2 class="text-body-sm font-semibold uppercase tracking-[0.06em] text-text-3">Stations</h2>
                <ul class="mt-4 grid grid-cols-2 gap-x-6 md:grid-cols-1">
                    @foreach ($items as $item)
                        <li>
                            <a href="{{ route($item['route']) }}" class="inline-flex min-h-11 items-center text-text-2 hover:text-text {{ $link }}">{{ $item['label'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="lg:col-span-2">
                <h2 class="text-body-sm font-semibold uppercase tracking-[0.06em] text-text-3">Contact</h2>
                <ul class="mt-4 text-text-2">
                    <li><a href="mailto:{{ config('studio.email') }}" class="inline-flex min-h-11 items-center hover:text-text {{ $link }}">{{ config('studio.email') }}</a></li>
                    <li><a href="tel:{{ preg_replace('/[^\d+]/', '', config('studio.phone')) }}" class="inline-flex min-h-11 items-center hover:text-text {{ $link }}">{{ config('studio.phone') }}</a></li>
                    <li class="flex min-h-11 items-center">{{ config('studio.location') }}</li>
                </ul>
            </div>
        </div>

        <div class="mt-14 flex flex-col-reverse items-start justify-between gap-4 border-t border-rule pt-6 text-body-sm text-text-3 sm:flex-row sm:items-center">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <x-theme-toggle />
        </div>
    </x-container>
</footer>
