<div class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden">
    <livewire:layouts.navbar />
    <div class="relative w-full bg-[#111422]">
        <div class="absolute inset-0 opacity-20 pointer-events-none" data-alt="Abstract dot pattern background"
            style="background-image: radial-linear(#1337ec 1px, transparent 1px); background-size: 32px 32px;">
        </div>
        <div class="relative px-4 sm:px-10 py-12 lg:py-16 flex flex-col items-center justify-center text-center gap-6">
            <h1
                class="text-slate-900 dark:text-white text-3xl sm:text-4xl lg:text-5xl font-black leading-tight tracking-tight max-w-3xl">
                Temukan Anime Favoritmu
            </h1>
            <p class="text-slate-500 dark:text-secondary text-base sm:text-lg font-normal max-w-2xl">
                Cari dari ribuan judul anime, mulai dari hits klasik hingga simulcast terbaru dengan kualitas
                terbaik.
            </p>
            <div class="w-full max-w-2xl mt-2">
                <div
                    class="flex w-full items-stretch rounded-xl shadow-lg shadow-primary/10 transition-all focus-within:shadow-primary/20">
                    <div
                        class="flex items-center justify-center pl-4 rounded-l-xl bg-white dark:bg-card-dark border border-r-0 border-none text-slate-400 dark:text-secondary">
                        <span class="material-symbols-outlined">search</span>
                    </div>
                    <input type="text" wire:model.live="search"
                        class="flex-1 bg-white dark:bg-card-dark outline-0 border-l-0 border-r-0 border-none border-y text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-secondary focus:ring-0 active:ring-0 focus:border-gray-200 dark:focus:border-border-dark h-14 px-3 text-base"
                        placeholder="Cari judul anime, contoh: One Piece..." />
                    <button type="submit"
                        class="bg-primary hover:bg-primary-hover text-white font-bold px-6 sm:px-8 rounded-r-xl transition-colors flex items-center gap-2">
                        <span>Cari</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- @dump($resultAnime) --}}
    <div class="flex flex-col lg:flex-row flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-10 py-8 gap-8">
        <aside class="w-full lg:w-72 shrink-0">
            {{-- <div
                class="lg:hidden flex items-center justify-between mb-4 bg-white dark:bg-card-dark p-4 rounded-xl border border-gray-200 dark:border-border-dark">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">filter_list</span> Filter
                </h3>
                <button
                    class="text-primary font-bold text-sm flex items-center gap-1 bg-primary/10 px-3 py-1.5 rounded-lg">
                    Buka Filter <span class="material-symbols-outlined text-lg">expand_more</span>
                </button>
            </div> --}}
            <div class="flex flex-col gap-6 sticky top-24 group">
                <div
                    class="bg-white dark:bg-card-dark rounded-xl border border-gray-200 dark:border-border-dark shadow-sm overflow-hidden">
                    <div
                        class="flex items-center justify-between p-5 border-b border-gray-200 dark:border-border-dark bg-gray-50/50 dark:bg-[#1f2336]/30">
                        <h3 class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">tune</span> Filter
                        </h3>
                        <button wire:click="clearFilter" type="button"
                            class="text-xs font-bold text-slate-500 hover:text-primary dark:text-secondary dark:hover:text-white transition-colors">
                            Reset Semua
                        </button>
                    </div>
                    <div class="flex flex-col divide-y divide-gray-200 dark:divide-border-dark">
                        <details class="group" open=''>
                            <summary
                                class="flex cursor-pointer items-center justify-between p-5 font-bold text-slate-800 dark:text-gray-100 hover:bg-gray-50 dark:hover:bg-[#1f2336]/50 transition-colors">
                                <span class="flex items-center gap-2 text-sm"><span
                                        class="material-symbols-outlined text-primary text-lg">info</span>
                                    Status</span>
                                <span
                                    class="material-symbols-outlined text-slate-400 transition-transform duration-200 group-open='':rotate-180">expand_more</span>
                            </summary>
                            <div class="px-5 pb-5 pt-0 space-y-3">
                                <label class="group/item flex items-center gap-3 cursor-pointer" wire:key='all'>
                                    <input checked
                                        class="h-4 w-4 border-gray-300 dark:border-gray-600 bg-transparent text-primary focus:ring-offset-0 focus:ring-0 focus:ring-offset-transparent checked:border-primary cursor-pointer"
                                        name="status" type="radio" wire:model.lazy='searchStatus' value="all" />
                                    <span
                                        class="text-slate-600 dark:text-gray-400 font-medium text-sm group-hover/item:text-primary transition-colors">
                                        All
                                    </span>
                                </label>
                                @foreach ($filterStatus as $status)
                                    <span class="group/item flex items-center gap-3 cursor-pointer"
                                        wire:key='{{ $status->value }}'>
                                        <input id="{{ $status->value }}"
                                            class="h-4 w-4 border-gray-300 dark:border-gray-600 bg-transparent text-primary focus:ring-offset-0 focus:ring-0 focus:ring-offset-transparent checked:border-primary cursor-pointer"
                                            type="radio" wire:model.lazy='searchStatus'
                                            value="{{ $status->value }}" />
                                        <label for="{{ $status->value }}"
                                            class="text-slate-600 w-full dark:text-gray-400 font-medium text-sm group-hover/item:text-primary transition-colors">
                                            {{ $status->name }}
                                        </label>
                                    </span>
                                @endforeach
                            </div>
                        </details>
                        <details class="group" open=''>
                            <summary
                                class="flex cursor-pointer items-center justify-between p-5 font-bold text-slate-800 dark:text-gray-100 hover:bg-gray-50 dark:hover:bg-[#1f2336]/50 transition-colors">
                                <span class="flex items-center gap-2 text-sm"><span
                                        class="material-symbols-outlined text-primary text-lg">category</span>
                                    Tipe</span>
                                <span
                                    class="material-symbols-outlined text-slate-400 transition-transform duration-200 group-open='':rotate-180">expand_more</span>
                            </summary>
                            <div class="px-5 pb-5 pt-0 space-y-3">
                                @foreach ($filterType as $type)
                                    <span wire:key='{{ $type->value }}'
                                        class="group/item flex items-center gap-3 cursor-pointer">
                                        <input wire:model.lazy='searchType' value="{{ $type->value }}"
                                            id="{{ $type->value }}"
                                            class="rounded h-4 w-4 border-gray-300 dark:border-gray-600 bg-transparent text-primary focus:ring-offset-0 focus:ring-0 focus:ring-offset-transparent checked:bg-primary cursor-pointer"
                                            type="checkbox" />
                                        <label for="{{ $type->value }}"
                                            class="text-slate-600 w-full dark:text-gray-400 font-medium text-sm group-hover/item:text-primary transition-colors">
                                            {{ $type->name }}
                                        </label>
                                    </span>
                                @endforeach
                            </div>
                        </details>
                        <details class="group" open=''>
                            <summary
                                class="flex cursor-pointer items-center justify-between p-5 font-bold text-slate-800 dark:text-gray-100 hover:bg-gray-50 dark:hover:bg-[#1f2336]/50 transition-colors">
                                <span class="flex items-center gap-2 text-sm"><span
                                        class="material-symbols-outlined text-primary text-lg">calendar_month</span>
                                    Tahun</span>
                                <span
                                    class="material-symbols-outlined text-slate-400 transition-transform duration-200 group-open='':rotate-180">expand_more</span>
                            </summary>
                            <div class="px-5 pb-5 pt-0">
                                <div class="flex items-center gap-2">
                                    <select name="year" id="year" wire:model.live='searchYearFrom'
                                        class="w-full bg-gray-50 dark:bg-black/20 border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-shadow">
                                        <option class="dark:bg-card-dark" value="">Dari</option>
                                        @foreach ($filterYear as $year)
                                            <option class="dark:bg-card-dark" value="{{ $year }}">
                                                {{ $year }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-slate-400">-</span>
                                    <select name="year" id="year" wire:model.live='searchYearTo'
                                        class="w-full bg-gray-50 dark:bg-black/20 border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-shadow">
                                        <option class="dark:bg-card-dark" value="">Ke</option>
                                        @foreach ($filterYear as $year)
                                            <option class="dark:bg-card-dark" value="{{ $year }}">
                                                {{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </details>
                        <details class="group" open=''="">
                            <summary
                                class="flex cursor-pointer items-center justify-between p-5 font-bold text-slate-800 dark:text-gray-100 hover:bg-gray-50 dark:hover:bg-[#1f2336]/50 transition-colors">
                                <span class="flex items-center gap-2 text-sm"><span
                                        class="material-symbols-outlined text-primary text-lg">theater_comedy</span>
                                    Genre</span>
                                <span
                                    class="material-symbols-outlined text-slate-400 transition-transform duration-200 group-open='':rotate-180">expand_more</span>
                            </summary>
                            <div class="px-5 pb-5 pt-0">
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($filterGenre as $genre)
                                        <span>
                                            <input value="{{ $genre->id }}" type="checkbox"
                                                wire:model.live='searchGenre' id="{{ $genre->id }}"
                                                class="hidden tabs-input">
                                            <label for="{{ $genre->id }}"
                                                class="tabs-label cursor-pointer px-3 py-1.5 rounded-lg bg-gray-50 dark:bg-black/20 text-slate-600 dark:text-gray-400 border border-gray-200 dark:border-border-dark text-xs font-medium hover:border-primary hover:text-primary dark:hover:text-primary transition-colors">
                                                {{ $genre->name }}
                                            </label>
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </details>
                    </div>
                </div>
            </div>
        </aside>
        <main class="flex-1">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                <p class="text-slate-600 dark:text-secondary text-sm font-medium">
                    Menampilkan <span
                        class="text-slate-900 dark:text-white font-bold">{{ $paginateAnime->count() }}</span> dari
                    <span class="text-slate-900 dark:text-white font-bold">{{ $paginateAnime->total() }}</span> anime
                </p>
                <div class="flex items-center gap-3">
                    <label
                        class="text-sm font-medium text-slate-600 dark:text-secondary whitespace-nowrap">Urutkan:</label>
                    <select wire:model.lazy='sorterFilter'
                        class="bg-white dark:bg-card-dark border border-gray-300 dark:border-border-dark text-slate-900 dark:text-white text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5">
                        <option value="title_asc">Judul A-Z</option>
                        <option value="title_desc">Judul Z-A</option>
                        <option value="latest">Terbaru</option>
                        <option value="top">Rating Tertinggi</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
                @foreach ($paginateAnime as $anime)
                    <a wire:navigate href="{{ route('pages.animes.show', $anime->slug) }}"
                        class="group relative flex flex-col gap-3 rounded-xl bg-white dark:bg-card-dark border border-gray-200 dark:border-border-dark p-2 hover:border-primary dark:hover:border-primary transition-all duration-200 shadow-sm hover:shadow-lg hover:shadow-primary/10">
                        <div class="relative aspect-3/4 w-full overflow-hidden rounded-lg">
                            <img alt="Anime Poster"
                                class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110"
                                data-alt="Anime boy character illustration with blue background"
                                src="{{ $anime->thumbnail_url }}" />
                            <div class="absolute top-2 left-2 flex flex-col gap-1">
                                <span
                                    class="bg-primary/90 backdrop-blur-sm text-white text-xxs font-bold px-2 py-0.5 rounded shadow-sm">
                                    {{ $anime->type->name }}
                                </span>
                            </div>
                            <div class="absolute top-2 right-2">
                                <span
                                    class="flex items-center gap-1 bg-black/60 backdrop-blur-sm text-yellow-400 text-xxs font-bold px-1.5 py-0.5 rounded shadow-sm">
                                    <span class="material-symbols-outlined text-[12px] fill-current">star</span>
                                    {{ $anime->rating }}
                                </span>
                            </div>
                            <div
                                class="absolute inset-0 bg-linear-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-3">
                                <button
                                    class="w-full bg-primary hover:bg-primary-hover text-white text-xs font-bold py-2 rounded-lg shadow-lg">Lihat
                                    Detail</button>
                            </div>
                        </div>
                        <div class="flex flex-col gap-1 px-1 pb-1">
                            <h3
                                class="text-slate-900 dark:text-white font-bold text-sm leading-tight line-clamp-1 group-hover:text-primary transition-colors">
                                {{ $anime->title }}
                            </h3>
                            <div class="flex items-center gap-2 text-[11px] text-slate-500 dark:text-secondary">
                                <span>{{ $anime->status->name }}</span>
                                <span class="w-1 h-1 rounded-full bg-slate-400 dark:bg-gray-600"></span>
                                <span>{{ $anime->release_date->year }}</span>
                            </div>
                            <div class="flex gap-1 mt-1 flex-wrap">
                                @foreach ($anime->genres as $genre)
                                    <span
                                        class="text-xxs text-slate-500 dark:text-gray-400 bg-gray-100 dark:bg-[#232948] px-1.5 py-0.5 rounded">
                                        {{ $genre->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="mt-10 flex justify-center">
                <nav role="navigation" class="flex items-center gap-2">
                    @if (!$paginateAnime->onFirstPage())
                        <button wire:click="previousPage('{{ $paginateAnime->getPageName() }}')"
                            class="flex items-center justify-center w-10 h-10 rounded-lg border border-gray-300 dark:border-border-dark text-slate-500 dark:text-secondary hover:bg-gray-100 dark:hover:bg-[#2f365f] disabled:opacity-50">
                            <span class="material-symbols-outlined text-sm">chevron_left</span>
                        </button>
                    @endif
                    {{-- @dd(is_string($paginateAnime->links()->elements)) --}}
                    @foreach ($paginateAnime->links()->elements[0] as $element => $link)
                        <button wire:key='paginator-{{ $element }}'
                            @class([
                                'flex items-center justify-center w-10 h-10 rounded-lg bg-card-dark text-white font-bold text-sm',
                                'bg-primary' => $element == $paginateAnime->currentPage(),
                            ])>{{ $element }}</button>
                    @endforeach
                    @if ($paginateAnime->hasMorePages())
                        <button wire:click="nextPage('{{ $paginateAnime->getPageName() }}')"
                            class="flex items-center justify-center w-10 h-10 rounded-lg border border-gray-300 dark:border-border-dark text-slate-500 dark:text-secondary hover:bg-gray-100 dark:hover:bg-[#2f365f]">
                            <span class="material-symbols-outlined text-sm">chevron_right</span>
                        </button>
                    @endif
                </nav>
            </div>
        </main>
    </div>
    <livewire:layouts.footer />
</div>
