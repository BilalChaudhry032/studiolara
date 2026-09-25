@props([
    'sources', // [['src' => url, 'type' => mime], ...]
    'poster' => null,
    'label', // what the video shows, for screen readers
])

{{--
    A short muted walkthrough. It plays while in view and pauses otherwise
    (motion.js, initVideos); with reduced motion it never starts on its own.
    The button always lets the visitor pause or play, and a pause is kept.
--}}
<figure {{ $attributes->merge(['class' => 'relative']) }} x-data="{ playing: false }">
    <video
        x-ref="video"
        data-autoplay
        muted
        loop
        playsinline
        preload="none"
        @if ($poster) poster="{{ $poster }}" @endif
        aria-label="{{ $label }}"
        class="block h-auto w-full border-4 border-text bg-panel"
        width="1280"
        height="800"
        @play="playing = true"
        @pause="playing = false"
    >
        @foreach ($sources as $source)
            <source src="{{ $source['src'] }}" type="{{ $source['type'] }}">
        @endforeach
    </video>
    <button
        type="button"
        class="absolute bottom-4 right-4 inline-flex min-h-11 items-center gap-2 bg-action px-4 text-body-sm font-semibold text-action-ink stretch-semi"
        @click="$refs.video.paused ? (delete $refs.video.dataset.userPaused, $refs.video.play()) : ($refs.video.dataset.userPaused = '1', $refs.video.pause())"
    >
        <x-heroicon-s-pause x-show="playing" x-cloak class="h-4 w-4" aria-hidden="true" />
        <x-heroicon-s-play x-show="! playing" class="h-4 w-4" aria-hidden="true" />
        <span x-text="playing ? 'Pause' : 'Play'">Play</span>
        <span class="sr-only">walkthrough</span>
    </button>
    @isset($caption)
        <figcaption class="mt-3 text-body-sm text-text-2">{{ $caption }}</figcaption>
    @endisset
</figure>
