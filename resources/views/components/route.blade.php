@props([
    'stations' => [], // each: ['label' => string, 'href' => ?string, 'note' => ?string]
    'line' => 'trunk', // trunk | u | w | s | m | c
    'orientation' => 'horizontal', // horizontal | vertical
    'size' => 'md', // sm | md | lg
    'current' => null, // index of the "you are here" station
    'currentType' => 'step', // aria-current value: page | step
    'progress' => false, // stations before `current` render as passed
])

@php
    // Diameter and stroke of the station marker, line thickness, and the
    // height of a vertical station row (marker and label share its centre).
    [$d, $border, $t, $row] = [
        'sm' => [12, 'border-2', 4, 32],
        'md' => [20, 'border-[3px]', 6, 36],
        'lg' => [26, 'border-4', 10, 52],
    ][$size];

    // Yellow on day white falls under 3:1, so it gets an ink casing like on printed maps.
    $stroke = [
        'trunk' => 'before:bg-text',
        'u' => 'before:bg-line-u',
        'w' => 'before:bg-line-w',
        's' => 'before:bg-line-s',
        'm' => 'before:bg-line-m before:shadow-[0_0_0_1.5px_rgb(var(--text))] dark:before:shadow-none',
        'c' => 'before:bg-line-c',
    ][$line];

    $labelType = [
        'horizontal' => [
            'sm' => 'text-[0.75rem] font-semibold uppercase tracking-[0.06em] stretch-condensed',
            'md' => 'text-body-sm font-semibold',
            'lg' => 'text-heading-md font-bold stretch-condensed',
        ],
        'vertical' => [
            'sm' => 'text-body-sm font-semibold',
            'md' => 'text-body-lg font-semibold',
            'lg' => 'text-heading-lg font-bold stretch-condensed',
        ],
    ][$orientation][$size];

    $n = max(count($stations), 1);
    $horizontal = $orientation === 'horizontal';
@endphp

@if ($horizontal)
    <ol
        {{ $attributes->merge(['class' => "relative grid before:absolute before:inset-x-[var(--route-inset)] before:top-[var(--route-top)] before:h-[var(--route-t)] before:content-[''] {$stroke}"]) }}
        style="grid-template-columns: repeat({{ $n }}, minmax(0, 1fr)); --route-top: {{ ($d - $t) / 2 }}px; --route-t: {{ $t }}px; --route-inset: calc(50% / {{ $n }});"
    >
@else
    <ol {{ $attributes->merge(['class' => 'relative']) }}>
@endif
    @foreach ($stations as $i => $station)
        @php
            $isCurrent = $current === $i;
            $state = $isCurrent ? 'current' : (($progress && $current !== null && $i < $current) ? 'passed' : 'upcoming');
            $marker = [
                'upcoming' => "bg-ground border-text {$border}",
                'passed' => "bg-text border-text {$border}",
                'current' => "bg-text border-text {$border} ring-[3px] ring-text ring-offset-[3px] ring-offset-ground",
            ][$state];
            $tag = empty($station['href']) ? 'div' : 'a';
        @endphp

        <li
            @class([
                'relative',
                'flex flex-col items-center text-center' => $horizontal,
                "pb-5 before:absolute before:bottom-[calc(var(--row)/-2)] before:left-[var(--route-x)] before:top-[calc(var(--row)/2)] before:w-[var(--route-t)] before:content-[''] {$stroke}" => ! $horizontal && ! $loop->last,
            ])
            @if (! $horizontal)
                style="--row: {{ $row }}px; --route-t: {{ $t }}px; --route-x: {{ ($d - $t) / 2 }}px;"
            @endif
            @if ($isCurrent) aria-current="{{ $currentType }}" @endif
        >
            <{{ $tag }}
                @if ($tag === 'a') href="{{ $station['href'] }}" @endif
                @class([
                    'group relative z-10 flex',
                    'flex-col items-center gap-2' => $horizontal,
                    'min-h-[var(--row)] items-start gap-4' => ! $horizontal,
                ])
            >
                <span
                    aria-hidden="true"
                    class="shrink-0 rounded-full transition-colors duration-150 {{ $marker }} {{ $tag === 'a' && $state === 'upcoming' ? 'group-hover:bg-text' : '' }}"
                    style="width: {{ $d }}px; height: {{ $d }}px;{{ $horizontal ? '' : ' margin-top: ' . (($row - $d) / 2) . 'px;' }}"
                ></span>
                {{-- Vertical labels may wrap; the first line stays centred on the marker. --}}
                <span @class([
                    $labelType,
                    'text-balance' => $horizontal,
                    'pt-[calc((var(--row)-1lh)/2)]' => ! $horizontal,
                    'underline decoration-2 underline-offset-[0.3em] decoration-transparent group-hover:decoration-current' => $tag === 'a',
                ])>{{ $station['label'] }}</span>
            </{{ $tag }}>

            @if (! empty($station['note']))
                <p @class([
                    'text-body-sm text-text-2',
                    'mt-1 max-w-[18ch]' => $horizontal,
                    'max-w-prose' => ! $horizontal,
                ]) @if (! $horizontal) style="margin-left: {{ $d + 16 }}px" @endif>{{ $station['note'] }}</p>
            @endif
        </li>
    @endforeach
</ol>
