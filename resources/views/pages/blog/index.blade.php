<x-layout
    title="Blog"
    description="Strategic thinking, design trends, and development best practices from building digital products."
>
    <section class="py-24 lg:py-32">
        <x-container class="mx-auto max-w-3xl text-center">
            <p class="text-eyebrow uppercase tracking-widest text-lime-500">Insights & Resources</p>
            <h1 class="mt-4 text-display-lg font-semibold text-paper">
                Stay Ahead With Insights on Product, Design & Growth
            </h1>
            <p class="mt-6 text-body-lg text-paper-dim">
                We share strategic thinking, design trends, development best practices, and lessons learned from building digital products.
            </p>
        </x-container>
    </section>

    @if ($categories->isNotEmpty())
        <section class="border-y border-ink-800 py-6">
            <x-marquee speed="22">
                @foreach ($categories as $category)
                    <span class="rounded-full border border-ink-700 px-4 py-2 text-body-sm text-paper-dim">{{ $category->name }}</span>
                @endforeach
            </x-marquee>
        </section>
    @endif

    <section class="py-24">
        <x-container>
            @if ($posts->isEmpty())
                <p class="text-center text-body-md text-paper-dim">No articles published yet — check back soon.</p>
            @else
                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($posts as $post)
                        <a href="{{ route('blog.show', $post) }}" class="group block">
                            @if ($post->getFirstMediaUrl('cover'))
                                <img
                                    src="{{ $post->getFirstMediaUrl('cover') }}"
                                    alt="{{ $post->title }}"
                                    class="aspect-[4/3] w-full rounded-2xl border border-ink-700 object-cover"
                                >
                            @else
                                <x-placeholder-image :label="$post->title" />
                            @endif

                            <p class="mt-4 text-body-sm uppercase tracking-widest text-lime-500">{{ $post->category?->name ?? 'Insights' }}</p>
                            <p class="mt-2 text-heading-md font-semibold text-paper group-hover:text-lime-500">{{ $post->title }}</p>
                            <p class="mt-2 text-body-sm text-paper-dim">{{ $post->excerpt }}</p>
                            <p class="mt-3 text-body-sm text-muted">
                                {{ $post->published_at?->format('M j, Y') }} · {{ $post->reading_time }} min read
                            </p>
                        </a>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $posts->links() }}
                </div>
            @endif
        </x-container>
    </section>

    {{-- NEWSLETTER --}}
    <section class="border-t border-ink-800 py-24">
        <x-container class="mx-auto max-w-xl text-center">
            <h2 class="text-heading-lg font-semibold text-paper">Get Insights Delivered to Your Inbox</h2>
            <p class="mt-4 text-body-md text-paper-dim">
                Sign up for weekly insights on product strategy, design, and growth.
            </p>
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
