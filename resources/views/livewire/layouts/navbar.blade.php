<nav
    class="sticky top-0 z-50 w-full border-b border-surface-hover bg-background-dark/95 backdrop-blur supports-backdrop-filter:bg-background-dark/80">
    <div class="layout-container flex h-16 items-center justify-between px-4 md:px-10 max-w-7xl mx-auto">
        {{-- Desktop View --}}
        <div class="flex items-center gap-8">

            {{-- Logo --}}
            <a class="flex items-center gap-2 group" href="/" wire:navigate>
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary text-white">
                    <span class="material-symbols-outlined text-[20px]">smart_display</span>
                </div>
                <span class="text-xl font-bold tracking-tight text-white">{{ config('app.name') }}</span>
            </a>

            {{-- Navigation links --}}
            <div class="hidden lg:flex items-center gap-1 p-1 rounded-lg border border-surface-border/50">
                @foreach ($navbars as $link => $title)
                    <a class="px-4 py-1.5 text-sm font-medium text-secondary hover:text-white hover:bg-surface-border/50 rounded transition-all"
                        href="{{ route($link) }}" wire:navigate wire:current="text-white bg-surface-border shadow-sm">
                        {{ $title }}
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Mobile view --}}
        <div x-data="{ open: false }" class="flex items-center gap-4">
            <div class="hidden lg:block">
                @foreach ($rightNavbars as $link => $title)
                    <a class="px-4 py-1.5 text-sm font-medium text-secondary hover:text-white hover:bg-surface-border/50 rounded transition-all"
                        href="{{ route($link) }}" wire:current="text-white bg-surface-border shadow-sm">
                        {{ $title }}
                    </a>
                @endforeach
            </div>

            <a href="{{ route('pages.anime-list') }}"
                class="px-4 py-1.5 text-sm font-medium text-secondary hover:text-white hover:bg-surface-border/50 rounded transition-all">
                <span class="material-symbols-outlined">search</span>
            </a>

            <button @click="open = !open"
                class="lg:hidden px-4 py-1.5 text-sm font-medium text-secondary hover:text-white hover:bg-surface-border/50 rounded transition-all">
                <span class="material-symbols-outlined" x-show="!open">menu</span>
                <span class="material-symbols-outlined" x-show="open">close</span>
            </button>

            {{-- Humberger --}}
            <div x-show="open" @click.away="open = false"
                class="absolute top-18 right-2 z-50 flex flex-col lg:hidden rounded-lg bg-background-dark/90 border border-surface-border/50 shadow-lg p-4 transition-all w-md"
                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
                @foreach ($navbars as $link => $title)
                    <a class="mb-2 px-4 py-2 text-base font-medium text-secondary hover:text-white hover:bg-surface-border/50 rounded transition-all"
                        href="{{ route($link) }}" wire:navigate.exact
                        wire:current="text-white bg-surface-border shadow-sm" wire:key="{{ $link }}">
                        {{ $title }}
                    </a>
                @endforeach
                <div>
                    @foreach ($rightNavbars as $link => $title)
                        <a class="mb-2 px-4 py-2 text-base font-medium text-secondary hover:text-white hover:bg-surface-border/50 rounded transition-all"
                            href="{{ route($link) }}" wire:current="text-white bg-surface-border shadow-sm">
                            {{ $title }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</nav>
