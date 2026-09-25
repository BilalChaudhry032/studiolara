{{-- The studio's name set as a small sign. The name comes from APP_NAME, so a rename needs no template change. --}}
<a href="{{ route('home') }}" {{ $attributes->merge(['class' => 'inline-block shrink-0 bg-sign pt-1 text-sign-ink']) }}>
    <span class="block border-t-2 border-sign-ink px-2.5 pb-1.5 pt-1 text-xl font-extrabold leading-none stretch-condensed">{{ config('app.name') }}</span>
</a>
