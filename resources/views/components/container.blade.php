@props([])

<div {{ $attributes->merge(['class' => 'mx-auto w-full max-w-container px-5 sm:px-8 lg:px-12']) }}>
    {{ $slot }}
</div>
