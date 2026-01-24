<div>
    <livewire:layouts.navbar />
    <main class="relative min-h-screen pb-20">
        <!-- Slidder Sections -->
        <livewire:layouts.slider :$trendingAnime />

        <!-- Contents sections -->
        <div class="layout-container mx-auto max-w-7xl px-4 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                {{-- Main Contents --}}
                <div class="lg:col-span-8 xl:col-span-9 flex flex-col gap-10">

                    {{-- Browse by genre --}}
                    <livewire:layouts.genres />

                    {{-- Animes --}}
                    <section class="border-b border-surface-hover pb-8">
                        <input checked class="hidden" id="tab-airing" name="content-tabs" type="radio" />
                        <input class="hidden" id="tab-completed" name="content-tabs" type="radio" />
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 tabs">
                            <div
                                class="flex flex-wrap gap-2 w-fit rounded-xl bg-surface-dark p-1 border border-white/5">
                                <label
                                    class="cursor-pointer rounded-lg px-4 py-2 text-sm font-bold text-gray-400 transition-all hover:text-white border border-transparent flex items-center gap-1"
                                    for="tab-airing">
                                    Sedang Tayang
                                </label>
                                <label
                                    class="cursor-pointer rounded-lg px-4 py-2 text-sm font-bold text-gray-400 transition-all hover:text-white border border-transparent flex items-center gap-1"
                                    for="tab-completed">
                                    Completed
                                </label>
                            </div>
                            <a class="text-sm font-medium text-primary hover:text-blue-400" href="{{ route('pages.anime-list') }}">View All</a>
                        </div>

                        {{-- Animes Contents --}}
                        <div class="content-airing hidden grid-cols-2 md:grid-cols-4 gap-4 transition-all2">
                            @forelse ($publishedAnime as $anime)
                                <livewire:layouts.animes.card :$anime wire:key='anime-ongoing-{{ $anime->id }}' />
                            @empty
                                <div>
                                    Belum ada mank!
                                </div>
                            @endforelse
                        </div>
                        <div class="content-completed hidden grid-cols-2 md:grid-cols-4 gap-4">
                            @forelse ($completedAnime as $anime)
                                <livewire:layouts.animes.card :$anime wire:key='anime-completed-{{ $anime->id }}' />
                            @empty
                                <div>
                                    Belum ada mank!
                                </div>
                            @endforelse
                        </div>
                    </section>

                    {{-- Episodes --}}
                    <section>
                        <div class="mb-6 flex items-center gap-3">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary/20 text-primary">
                                <span class="material-symbols-outlined">new_releases</span>
                            </div>
                            <h2 class="text-2xl font-bold tracking-tight text-white">Latest Episodes</h2>
                        </div>
                        <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6">
                            @forelse ($latestEpisode as $episode)
                                <livewire:layouts.episodes.card :$episode wire:key='{{ $episode->id }}' />
                            @empty
                                <div>
                                    Belum ada mank!
                                </div>
                            @endforelse
                        </div>
                        <div class="mt-8 flex justify-center">
                            <button wire:click='loadMoreEpisode'
                                class="flex h-10 items-center justify-center gap-2 rounded-lg bg-surface-hover px-6 text-sm font-bold text-white transition-colors hover:bg-white hover:text-black">
                                Load More Episodes
                                <span class="material-symbols-outlined text-sm">expand_more</span>
                            </button>
                        </div>
                    </section>
                </div>

                {{-- TOP 6 --}}
                <aside class="lg:col-span-4 xl:col-span-3">
                    <div class="flex flex-col gap-8 sticky top-24">
                        <div class="rounded-2xl bg-surface-dark p-6 ring-1 ring-white/5">
                            <h3 class="mb-5 text-xl font-bold text-white flex items-center gap-2">
                                <span class="material-symbols-outlined text-yellow-500">trophy</span>
                                Top 6 Anime
                            </h3>
                            <div class="flex flex-col gap-4">
                                @foreach ($popularAnime as $anime)
                                    <a class="group flex items-center gap-3" href="{{ route('pages.animes.show', $anime->slug) }}">
                                        <div
                                            class="relative h-16 w-12 shrink-0 overflow-hidden rounded-md bg-surface-hover">
                                            <div class="absolute inset-0 bg-cover bg-center"
                                                data-alt="Anime poster abstract"
                                                style="
                                                background-image: url('{{ $anime->poster_url }}');
                                            ">
                                            </div>
                                            <div @class([
                                                'absolute top-0 left-0 px-1 py-0.5 text-[10px] font-bold text-black' => true,
                                                'bg-green-500' => $loop->iteration === 1,
                                                'bg-yellow-500' => $loop->iteration === 2,
                                                'bg-red-500' => $loop->iteration === 3,
                                                'bg-gray-500' => $loop->iteration > 3,
                                            ])>
                                                #{{ $loop->iteration }}
                                            </div>
                                            <div
                                                class="absolute bottom-0 inset-x-0 bg-black/60 py-0.5 text-center text-[8px] font-bold text-white tracking-wide">
                                                TV</div>
                                        </div>
                                        <div class="flex flex-col justify-center">
                                            <h4
                                                class="text-sm font-bold text-white group-hover:text-primary line-clamp-1">
                                                {{ $anime->title }}
                                            </h4>
                                            <p class="text-xs text-gray-400">
                                                @foreach ($anime->genres as $genre)
                                                    {{ $genre->name }}{{ $loop->last ? '' : ',' }}
                                                @endforeach
                                            </p>
                                            <div class="flex items-center gap-1 mt-1">
                                                <span
                                                    class="material-symbols-outlined text-[12px] text-yellow-500 filled">star</span>
                                                <span
                                                    class="text-xxs font-medium text-gray-300">{{ $anime->rating }}</span>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <button wire:click="goto"
                                class="mt-6 w-full rounded-lg bg-surface-hover py-2 text-xs font-bold text-white transition-colors hover:bg-primary">View
                                Full Ranking</button>
                        </div>
                        <div class="overflow-hidden rounded-2xl bg-linear-to-br from-primary to-blue-900 p-6 relative">
                            <div class="relative z-10">
                                <h3 class="text-lg font-bold text-white mb-2">Request Anime?</h3>
                                <p class="text-xs text-blue-100 mb-4">Can't find what you're looking for? Let us know!
                                </p>
                                <button
                                    class="rounded-lg bg-white py-2 px-4 text-xs font-bold text-primary hover:bg-gray-100">Make
                                    a Request</button>
                            </div>
                            <div class="absolute -bottom-4 -right-4 text-blue-500/30">
                                <span class="material-symbols-outlined text-[120px]">mark_chat_unread</span>
                            </div>
                        </div>
                    </div>
                </aside>

            </div>
        </div>
    </main>
    <livewire:layouts.footer />
</div>
