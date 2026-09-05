<x-layout
    :title="$post->title"
    :description="$post->excerpt"
    :image="$post->getFirstMediaUrl('cover') ?: null"
    type="article"
>
    <x-slot:head>
        <script type="application/ld+json">
            {!! json_encode([
                '@context' => 'https://schema.org',
                '@type' => 'Article',
                'headline' => $post->title,
                'description' => $post->excerpt,
                'datePublished' => $post->published_at?->toIso8601String(),
                'dateModified' => $post->updated_at->toIso8601String(),
                'author' => [
                    '@type' => 'Person',
                    'name' => $post->author,
                ],
                'publisher' => [
                    '@type' => 'Organization',
                    'name' => config('app.name'),
                ],
                'mainEntityOfPage' => url()->current(),
            ], JSON_UNESCAPED_SLASHES) !!}
        </script>
    </x-slot:head>

    <section class="py-16 lg:py-24">
        <x-container class="mx-auto max-w-3xl">
            <p class="text-eyebrow uppercase tracking-widest text-lime-500">{{ $post->category?->name ?? 'Insights' }}</p>
            <h1 class="mt-4 text-display-md font-semibold text-paper">{{ $post->title }}</h1>
            <p class="mt-4 text-body-sm text-muted">
                {{ $post->author }} · {{ $post->published_at?->format('M j, Y') }} · {{ $post->reading_time }} min read
            </p>
        </x-container>

        <x-container class="mx-auto mt-10 max-w-4xl">
            @if ($post->getFirstMediaUrl('cover'))
                <img
                    src="{{ $post->getFirstMediaUrl('cover') }}"
                    alt="{{ $post->title }}"
                    class="aspect-video w-full rounded-2xl border border-ink-700 object-cover"
                >
            @else
                <x-placeholder-image :label="$post->title" ratio="aspect-video" />
            @endif
        </x-container>

        <x-container class="mx-auto mt-10 max-w-3xl">
            <div class="prose prose-invert prose-lime max-w-none text-body-md text-paper-dim">
                {!! $post->body !!}
            </div>
        </x-container>
    </section>

    {{-- FOOTER CTA --}}
    <section class="border-t border-ink-800 py-24">
        <x-container class="mx-auto max-w-2xl text-center">
            <h2 class="text-display-md font-semibold text-paper">Ready to Put This Into Practice?</h2>
            <p class="mt-4 text-body-lg text-paper-dim">
                Book a free strategy call and we'll help you apply these ideas to your own product.
            </p>
            <div class="mt-8 flex flex-wrap justify-center gap-4">
                <x-button href="{{ route('contact') }}" variant="primary">Book a Call</x-button>
                <x-button href="{{ route('services.index') }}" variant="outline">Explore Services</x-button>
            </div>
        </x-container>
    </section>

    {{-- NEWSLETTER --}}
    <section class="border-t border-ink-800 py-24">
        <x-container class="mx-auto max-w-xl text-center">
            <h2 class="text-heading-lg font-semibold text-paper">Get Insights Delivered to Your Inbox</h2>
            @if (session('status'))
                <p class="mt-4 text-body-sm text-lime-500">{{ session('status') }}</p>
            @endif
            <form method="POST" action="{{ route('newsletter.store') }}" class="mt-6 flex flex-col gap-3 sm:flex-row">
                @csrf
                <input
                    type="email"
                    name="email"
                    required
                    placeholder="you@company.com"
                    class="w-full rounded-lg border border-ink-700 bg-ink-950 px-4 py-3 text-body-md text-paper focus-visible:border-lime-500"
                >
                <x-button type="submit" class="shrink-0">Subscribe</x-button>
            </form>
        </x-container>
    </section>
</x-layout>
