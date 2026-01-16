<header class="relative w-full">
    <div class="mx-auto max-w-7xl px-4 md:px-10 py-6">
        @isset($trendingAnime)
            <div class="relative overflow-hidden rounded-2xl bg-surface-dark shadow-2xl">
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 hover:scale-105"
                    data-alt="Dramatic anime scene with dark moody lighting and characters looking at a distant light"
                    style="background-image: url('{{ $trendingAnime->getFirstMediaUrl('trending', 'thumbnail') }}');">
                </div>
                <div class="absolute inset-0 bg-linear-to-t from-background-dark via-background-dark/60 to-transparent">
                </div>
                <div class="absolute inset-0 bg-linear-to-r from-background-dark/90 via-background-dark/40 to-transparent">
                </div>
                <div class="relative z-10 flex min-h-100 md:min-h-125 flex-col justify-end p-6 md:p-12 max-w-3xl">
                    <div class="mb-4 flex items-center gap-2">
                        <span
                            class="inline-flex items-center rounded-md bg-primary px-2.5 py-0.5 text-xs font-semibold text-white">Trending
                            #1</span>
                        @forelse ($trendingAnime->genres as $genre)
                            <span
                                class="inline-flex items-center rounded-md bg-white/10 px-2.5 py-0.5 text-xs font-semibold text-white backdrop-blur-sm">
                                {{ $genre->name }}
                            </span>
                        @empty
                        @endforelse
                    </div>
                    <h1
                        class="mb-2 text-4xl font-black leading-tight tracking-tight text-white md:text-5xl lg:text-6xl drop-shadow-lg">
                        {{ $trendingAnime->title }}
                    </h1>
                    <div class="mb-8 line-clamp-3 text-sm text-gray-200 md:text-base lg:text-lg max-w-2xl text-shadow-sm">
                       {{ str($trendingAnime->synopsis)->stripTags() }}
                    </div>
                    <div class="flex flex-wrap gap-4 h-12">
                        <livewire:partials.link title="Watch Now" logo="play_arrow" :href="route('pages.episodes.show', [$trendingAnime->slug, $trendingAnime->episodes->first()->number ?? ''])" />
                        <livewire:partials.link title="View Details" logo="info" :href="route('pages.animes.show', $trendingAnime->slug)" class="bg-white/10 text-white backdrop-blur-md hover:bg-white/20">
                    </div>
                </div>
            </div>
        @endisset
    </div>
</header>
