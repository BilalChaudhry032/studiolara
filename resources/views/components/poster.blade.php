@props([
    'href',
    'title',
    'subtitle' => null,
    'lines' => [], // line keys of the services this journey used
    'image' => null,
    'alt' => '',
    'sample' => false,
])

{{--
    A case study as a platform poster: a framed image, or a typographic
    poster (route bullets and title) when no image exists yet. "Sample
    project" marks demonstration work so it is never mistaken for a client.
--}}
<a href="{{ $href }}" {{ $attributes->merge(['class' => 'group block']) }}>
    <div class="relative aspect-[4/5] overflow-hidden border-4 border-text bg-sign">
        @if ($image)
            <img
                src="{{ $image }}"
                alt="{{ $alt }}"
                loading="lazy"
                class="h-full w-full object-cover transition-transform duration-500 ease-out-expo group-hover:scale-[1.03]"
            >
        @else
            <div class="flex h-full flex-col justify-between p-5 text-sign-ink md:p-6">
                <div class="flex gap-2">
                    @foreach ($lines as $line)
                        <x-bullet :line="$line" size="lg" />
                    @endforeach
                </div>
                <p aria-hidden="true" class="text-display-md font-extrabold stretch-condensed transition-transform duration-500 ease-out-expo group-hover:-translate-y-1">{{ $title }}</p>
            </div>
        @endif

        @if ($sample)
            <span class="absolute right-3 top-3 bg-ground px-2 py-1 text-[0.75rem] font-semibold uppercase tracking-[0.06em] text-text">Sample project</span>
        @endif
    </div>

    <div class="mt-4 flex items-start justify-between gap-4">
        <div>
            <p class="text-heading-md font-bold stretch-semi">{{ $title }}</p>
            @if ($subtitle)
                <p class="mt-1 text-body-sm text-text-2">{{ $subtitle }}</p>
            @endif
        </div>
        <x-arrow class="mt-1 text-heading-md transition-transform duration-150 ease-out-expo group-hover:translate-x-1" />
    </div>
</a>
