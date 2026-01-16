<nav
    class="sticky top-0 z-50 w-full border-b border-surface-hover bg-background-dark/95 backdrop-blur supports-backdrop-filter:bg-background-dark/80">
    <div class="layout-container flex h-16 items-center justify-between px-4 md:px-10 max-w-7xl mx-auto">
        <div class="flex items-center gap-8">
            <a class="flex items-center gap-2 group" href="/" wire:navigate>
                <livewire:partials.app.logo />
                <span class="text-xl font-bold tracking-tight text-white">{{ config('app.name') }}</span>
            </a>
            <div class="hidden md:flex items-center gap-1 p-1 rounded-lg border border-surface-border/50">
                @foreach ($navbars as $link => $title)
                    <a class="px-4 py-1.5 text-sm font-medium text-secondary hover:text-white hover:bg-surface-border/50 rounded transition-all"
                        href="{{ route($link) }}" wire:navigate.exact wire:current="text-white bg-surface-border shadow-sm">
                        {{ $title }}
                    </a>
                @endforeach
            </div>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('pages.anime-list') }}" class="px-4 py-1.5 text-sm font-medium text-secondary hover:text-white hover:bg-surface-border/50 rounded transition-all">
                <span class="material-symbols-outlined">search</span>
            </a>
            <button
                class="md:hidden px-4 py-1.5 text-sm font-medium text-secondary hover:text-white hover:bg-surface-border/50 rounded transition-all">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
    </div>
</nav>
