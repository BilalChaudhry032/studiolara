@props([
    'line', // one of App\Models\Service::LINES keys: u | w | s | m | c
    'size' => 'md', // sm | md | lg | xl
])

@php
    $fill = [
        'u' => 'bg-line-u text-line-ink',
        'w' => 'bg-line-w text-line-ink',
        's' => 'bg-line-s text-line-ink',
        'm' => 'bg-line-m text-line-m-ink',
        'c' => 'bg-line-c text-line-ink',
    ][$line];

    $box = [
        'sm' => 'h-6 w-6 text-[0.8125rem]',
        'md' => 'h-8 w-8 text-lg',
        'lg' => 'h-12 w-12 text-[1.625rem]',
        'xl' => 'h-20 w-20 text-[2.75rem]',
    ][$size];
@endphp

{{-- Route bullet. Decorative: always sits next to the service's written name, so colour never carries meaning alone. --}}
<span aria-hidden="true" {{ $attributes->merge(['class' => "inline-flex shrink-0 select-none items-center justify-center rounded-full font-extrabold leading-none stretch-condensed {$fill} {$box}"]) }}>{{ strtoupper($line) }}</span>
