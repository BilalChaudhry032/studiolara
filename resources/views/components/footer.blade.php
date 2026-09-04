@php($navItems = config('navigation.main'))

<footer class="border-t border-ink-800 bg-ink-950">
    <x-container class="grid gap-12 py-16 lg:grid-cols-4">
        <div class="lg:col-span-2">
            <a href="{{ route('home') }}" class="text-heading-md font-semibold text-paper">
                {{ config('app.name') }}
            </a>
            <p class="mt-4 max-w-sm text-body-md text-paper-dim">
                We design & build digital products that actually grow businesses.
            </p>
        </div>

        <div>
            <p class="text-eyebrow uppercase tracking-widest text-muted">Navigate</p>
            <ul class="mt-4 space-y-3">
                @foreach ($navItems as $item)
                    <li>
                        <a href="{{ route($item['route']) }}" class="text-body-sm text-paper-dim transition-colors duration-300 hover:text-lime-500">
                            {{ $item['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div>
            <p class="text-eyebrow uppercase tracking-widest text-muted">Contact</p>
            <ul class="mt-4 space-y-3 text-body-sm text-paper-dim">
                <li>
                    <a href="mailto:contact@agency.com" class="transition-colors duration-300 hover:text-lime-500">contact@agency.com</a>
                </li>
                <li>
                    <a href="tel:+15551234567" class="transition-colors duration-300 hover:text-lime-500">+1 (555) 123-4567</a>
                </li>
                <li>New York, USA</li>
            </ul>
        </div>
    </x-container>

    <div class="border-t border-ink-800 py-6">
        <x-container class="flex flex-col items-center justify-between gap-4 text-body-sm text-muted sm:flex-row">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>Built with care.</p>
        </x-container>
    </div>
</footer>
