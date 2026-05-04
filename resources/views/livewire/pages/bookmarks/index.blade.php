<div class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden">
    <livewire:layouts.navbar />
    <div class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-10 py-8">
        <h1 class="text-3xl font-black text-white mb-2">Bookmark saya</h1>
        <p class="text-secondary text-sm mb-8">Anime yang kamu simpan ditampilkan di bawah ini.</p>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @forelse ($bookmarks as $bookmark)
                <livewire:layouts.animes.card :anime="$bookmark->anime"
                    wire:key="bookmark-{{ $bookmark->id }}" />
            @empty
                <div class="col-span-full text-center py-16 rounded-xl border border-surface-hover bg-surface-dark/40">
                    <p class="text-secondary mb-4">Belum ada anime di bookmark.</p>
                    <a href="{{ route('pages.anime-list') }}" wire:navigate
                        class="inline-flex items-center gap-2 text-primary font-semibold hover:underline">
                        Jelajahi daftar anime
                        <span class="material-symbols-outlined text-lg">arrow_forward</span>
                    </a>
                </div>
            @endforelse
        </div>

        @if ($bookmarks->hasPages())
            <div class="mt-10 flex justify-center">
                <nav role="navigation" class="flex items-center gap-2">
                    @if (!$bookmarks->onFirstPage())
                        <button wire:click="previousPage('{{ $bookmarks->getPageName() }}')"
                            class="flex items-center justify-center w-10 h-10 rounded-lg border border-gray-300 dark:border-border-dark text-slate-500 dark:text-secondary hover:bg-gray-100 dark:hover:bg-[#2f365f] disabled:opacity-50">
                            <span class="material-symbols-outlined text-sm">chevron_left</span>
                        </button>
                    @endif
                    @foreach ($bookmarks->links()->elements as $segmentIndex => $segment)
                        @if (is_array($segment))
                            @foreach ($segment as $page => $url)
                                <button wire:key="bookmark-page-{{ $page }}-seg-{{ $segmentIndex }}"
                                    wire:click="gotoPage({{ $page }}, '{{ $bookmarks->getPageName() }}')"
                                    @class([
                                        'flex items-center justify-center w-10 h-10 rounded-lg bg-card-dark text-white font-bold text-sm',
                                        'bg-primary' => $page == $bookmarks->currentPage(),
                                    ])>{{ $page }}</button>
                            @endforeach
                        @else
                            <span wire:key="bookmark-ellipsis-{{ $segmentIndex }}"
                                class="flex items-center justify-center min-w-10 h-10 px-1 text-secondary text-sm font-bold select-none">{{ $segment }}</span>
                        @endif

                        @endforeach
                    @if ($bookmarks->hasMorePages())
                        <button wire:click="nextPage('{{ $bookmarks->getPageName() }}')"
                            class="flex items-center justify-center w-10 h-10 rounded-lg border border-gray-300 dark:border-border-dark text-slate-500 dark:text-secondary hover:bg-gray-100 dark:hover:bg-[#2f365f]">
                            <span class="material-symbols-outlined text-sm">chevron_right</span>
                        </button>
                    @endif
                </nav>
            </div>
        @endif
    </div>
    <livewire:layouts.footer />
</div>
