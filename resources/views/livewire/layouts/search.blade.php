<section class="absolute top-10 md:relative md:top-0 md:block!" x-cloak :class="{ 'block': showSearch, 'hidden': !showSearch }">
    <div class="fixed w-full md:relative z-20 mx-auto max-w-7xl px-4 md:px-10 -mt-8 mb-12">
        <div class="relative flex items-center rounded-xl bg-surface-dark p-2 shadow-xl ring-1 ring-white/10">
            <div class="flex h-12 w-12 items-center justify-center text-gray-400">
                <span class="material-symbols-outlined">search</span>
            </div>
            <input id="search"
                class="h-12 w-full border-none bg-transparent text-base text-white placeholder-gray-500 focus:ring-0 focus:outline-none"
                placeholder="Search anime, genre, or batch..." type="text" x-ref="searchInput"/>
            <button
                class="block h-10 rounded-lg bg-surface-hover px-4 text-sm font-bold text-white transition-colors hover:bg-primary hover:text-white">
                Search
            </button>
        </div>
    </div>
</section>
