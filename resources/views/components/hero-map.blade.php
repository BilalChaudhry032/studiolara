@props([
    'lines', // service line keys, in service order
    'stations', // process station names; the first is the interchange
])

@php
    /**
     * Offsets a polyline sideways by $k, keeping every segment parallel to
     * the centre line. At each bend the offset runs along the miter,
     * (n1 + n2) / (1 + n1·n2), so the spacing between parallel lines holds
     * through 45° and 90° turns, as on a drawn transit diagram.
     */
    $offset = function (array $points, float $k): string {
        $normal = function (array $a, array $b): array {
            [$dx, $dy] = [$b[0] - $a[0], $b[1] - $a[1]];
            $length = hypot($dx, $dy);

            return [$dy / $length, -$dx / $length];
        };

        $last = count($points) - 1;
        $out = [];
        foreach ($points as $i => $p) {
            if ($i === 0 || $i === $last) {
                $m = $i === 0 ? $normal($points[0], $points[1]) : $normal($points[$last - 1], $points[$last]);
            } else {
                [$a, $b] = [$normal($points[$i - 1], $p), $normal($p, $points[$i + 1])];
                $dot = $a[0] * $b[0] + $a[1] * $b[1];
                $m = [($a[0] + $b[0]) / (1 + $dot), ($a[1] + $b[1]) / (1 + $dot)];
            }
            $out[] = round($p[0] + $k * $m[0], 2) . ' ' . round($p[1] + $k * $m[1], 2);
        }

        return 'M' . implode(' L', $out);
    };

    $stroke = ['u' => 'stroke-line-u', 'w' => 'stroke-line-w', 's' => 'stroke-line-s', 'm' => 'stroke-line-m', 'c' => 'stroke-line-c'];
    $n = count($lines);

    // Desktop: the bundle enters from beyond the right edge, turns down at
    // 45° and meets the trunk at the first station. Coordinates are in a
    // 1280-wide viewBox, so stations sit at 10/30/50/70/90% and line up
    // with the five-column label grid below.
    $wide = ['gap' => 18, 'width' => 10, 'path' => [[2000, 52], [232, 52], [128, 156], [128, 200]]];

    // Phones: a fixed-size drawing (no scaling) whose trunk leaves at x=13,
    // exactly where the process line below picks it up.
    $narrow = ['gap' => 10, 'width' => 6, 'path' => [[900, 24], [62, 24], [13, 73], [13, 104]]];
@endphp

<div {{ $attributes }}>
    <p class="sr-only">
        All {{ $n }} service lines join one team at {{ $stations[0] }}, then run as one line through {{ implode(', ', array_slice($stations, 1, -1)) }} and {{ end($stations) }} to launch.
    </p>

    {{-- Tablet and desktop --}}
    <div class="relative hidden md:block" aria-hidden="true">
        <svg data-hero-map viewBox="0 0 1280 230" class="block w-full overflow-visible" fill="none" stroke-linejoin="round">
            @foreach ($lines as $i => $line)
                @php($d = $offset($wide['path'], ($i - ($n - 1) / 2) * $wide['gap']))
                @if ($line === 'm')
                    <path data-draw="bundle" data-line="{{ $i }}" d="{{ $d }}" class="stroke-text dark:hidden" stroke-width="{{ $wide['width'] + 3 }}" />
                @endif
                <path data-draw="bundle" data-line="{{ $i }}" d="{{ $d }}" class="{{ $stroke[$line] }}" stroke-width="{{ $wide['width'] }}" />
            @endforeach

            <path data-draw="trunk" d="M128 200 H1250" class="stroke-text" stroke-width="12" />

            <rect data-pop x="{{ 128 - (($n - 1) * $wide['gap'] + 30) / 2 }}" y="186" width="{{ ($n - 1) * $wide['gap'] + 30 }}" height="28" rx="14" class="fill-ground stroke-text" stroke-width="5" />
            @foreach ([384, 640, 896, 1152] as $x)
                <circle data-pop cx="{{ $x }}" cy="200" r="12" class="fill-ground stroke-text" stroke-width="5" />
            @endforeach
            <rect data-pop x="1244" y="178" width="12" height="44" class="fill-text" />
        </svg>

        <span class="absolute right-0 top-[40%] text-body-sm font-bold uppercase tracking-[0.06em] stretch-condensed">Launch</span>

        <ol class="mt-3 grid grid-cols-5 text-center">
            @foreach ($stations as $station)
                <li class="text-heading-md font-bold stretch-condensed">{{ $station }}</li>
            @endforeach
        </ol>
    </div>

    {{-- Phones --}}
    <div class="relative md:hidden" aria-hidden="true">
        <svg data-hero-map width="350" height="150" viewBox="0 0 350 150" class="block max-w-none overflow-visible" fill="none" stroke-linejoin="round">
            @foreach ($lines as $i => $line)
                @php($d = $offset($narrow['path'], ($i - ($n - 1) / 2) * $narrow['gap']))
                @if ($line === 'm')
                    <path data-draw="bundle" data-line="{{ $i }}" d="{{ $d }}" class="stroke-text dark:hidden" stroke-width="{{ $narrow['width'] + 3 }}" />
                @endif
                <path data-draw="bundle" data-line="{{ $i }}" d="{{ $d }}" class="{{ $stroke[$line] }}" stroke-width="{{ $narrow['width'] }}" />
            @endforeach

            <path data-draw="trunk" d="M13 104 V150" class="stroke-text" stroke-width="6" />
            <rect data-pop x="{{ 13 - (($n - 1) * $narrow['gap'] + 22) / 2 }}" y="94" width="{{ ($n - 1) * $narrow['gap'] + 22 }}" height="20" rx="10" class="fill-ground stroke-text" stroke-width="4" />
        </svg>

        <span class="absolute left-14 top-[94px] text-body-sm font-bold uppercase leading-5 tracking-[0.06em] stretch-condensed">One team</span>
    </div>
</div>
