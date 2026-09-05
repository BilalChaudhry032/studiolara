@props([
    'src' => null,
    'poster' => null,
    'label' => 'Hero background video',
])

{{--
    Desktop-only autoplay/muted/looped background video with a pause toggle,
    per the confirmed tapline.studio hero pattern — Home page only. Mobile
    always gets a static poster image instead (never the video), for load
    time and battery, not just a smaller version of the same element.

    No real video asset exists yet, so `src` defaults to null and this
    renders the placeholder box until one is provided (e.g. via a Filament
    media field) — the interactive scaffolding (pause toggle, responsive
    swap) is fully wired either way.
--}}
<div {{ $attributes->merge(['class' => 'relative']) }}>
    @if ($src)
        <div x-data="{ playing: true }" class="relative hidden lg:block">
            <video
                x-ref="video"
                autoplay
                muted
                loop
                playsinline
                @if ($poster) poster="{{ $poster }}" @endif
                class="aspect-video w-full rounded-2xl border border-ink-700 object-cover"
            >
                <source src="{{ $src }}" type="video/mp4">
            </video>

            <button
                type="button"
                @click="playing = !playing; playing ? $refs.video.play() : $refs.video.pause()"
                class="absolute bottom-4 right-4 flex h-10 w-10 items-center justify-center rounded-full bg-ink-950/80 text-paper backdrop-blur transition-colors duration-300 hover:text-lime-500"
                :aria-label="playing ? 'Pause video' : 'Play video'"
            >
                <x-heroicon-o-pause x-show="playing" x-cloak class="h-5 w-5" />
                <x-heroicon-o-play x-show="!playing" x-cloak class="h-5 w-5" />
            </button>
        </div>

        {{-- Mobile: static poster only, never the video --}}
        @if ($poster)
            <img src="{{ $poster }}" alt="" class="aspect-video w-full rounded-2xl border border-ink-700 object-cover lg:hidden">
        @else
            <x-placeholder-image :label="$label" ratio="aspect-video" class="lg:hidden" />
        @endif
    @else
        <x-placeholder-image :label="$label . ' (no video file yet — drop one in to enable; desktop-only, mobile keeps a static poster)'" ratio="aspect-video" />
    @endif
</div>
