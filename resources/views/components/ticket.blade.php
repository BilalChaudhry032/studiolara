@props([
    'name',
    'tagline' => null,
    'price',
    'duration',
    'bestFor' => null,
])

{{--
    Fare ticket: the plan on the body, fare and journey time on a perforated
    stub. The notches are ground-coloured discs, so place tickets on the page
    ground rather than on a panel. `deliverables` and `action` are slots.
--}}
<article {{ $attributes->merge(['class' => 'relative flex flex-col bg-panel md:flex-row']) }}>
    <div class="flex-1 p-6 md:p-8">
        <h3 class="text-heading-lg font-bold stretch-condensed">{{ $name }}</h3>
        @if ($tagline)
            <p class="mt-1 text-body-md font-semibold text-text-2">{{ $tagline }}</p>
        @endif
        @if ($bestFor)
            <p class="mt-4 max-w-prose text-body-md text-text-2">
                <span class="font-semibold text-text">Best for:</span> {{ $bestFor }}
            </p>
        @endif
        {{-- The slot sets its own top margin, so a caller can hide it at some sizes without leaving a gap. --}}
        {{ $deliverables ?? '' }}
    </div>

    <div class="relative flex flex-col justify-between gap-6 border-t-2 border-dashed border-text-3 bg-sign p-6 text-sign-ink md:w-64 md:border-l-2 md:border-t-0 md:p-8">
        <span aria-hidden="true" class="absolute -left-3 -top-3 h-6 w-6 rounded-full bg-ground"></span>
        <span aria-hidden="true" class="absolute -right-3 -top-3 h-6 w-6 rounded-full bg-ground md:-bottom-3 md:-left-3 md:right-auto md:top-auto"></span>

        <dl class="space-y-4">
            <div>
                <dt class="text-body-sm font-semibold opacity-80">Fare</dt>
                <dd class="text-heading-md font-bold stretch-condensed tabular">{{ $price }}</dd>
            </div>
            <div>
                <dt class="text-body-sm font-semibold opacity-80">Journey time</dt>
                <dd class="text-heading-md font-bold stretch-condensed tabular">{{ $duration }}</dd>
            </div>
        </dl>

        @isset($action)
            {{ $action }}
        @endisset
    </div>
</article>
