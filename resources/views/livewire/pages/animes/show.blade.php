<div>
    <livewire:layouts.navbar />
    <main class="flex-1 flex flex-col items-center w-full">
        <div class="w-full max-w-7xl px-4 md:px-10 py-4">
            <div class="flex flex-wrap gap-2 items-center text-sm">
                <a class="text-secondary hover:text-white transition-colors" href="/">Home</a>
                <span class="text-secondary">/</span>
                <a class="text-secondary hover:text-white transition-colors">Anime List</a>
                <span class="text-secondary">/</span>
                <span class="text-primary font-medium">{{ $anime->title }}</span>
            </div>
        </div>
        <div class="w-full max-w-7xl px-4 md:px-10 pb-10">
            {{--  --}}
            <div class="relative overflow-hidden rounded-2xl bg-surface-darker border border-surface-dark">
                <div class="absolute inset-0 z-0">
                    <div class="w-full h-full bg-cover bg-center opacity-20 blur-xl"
                        data-alt="Abstract blurry anime background"
                        style="background-image: url('{{ $anime->banner_url }}');">
                    </div>
                    <div class="absolute inset-0 bg-linear-to-t from-[#111422] via-[#111422]/80 to-transparent"></div>
                </div>
                <div class="relative z-10 flex flex-col md:flex-row gap-8 p-8 md:p-12 items-start">
                    <div class="shrink-0 mx-auto md:mx-0">
                        <div
                            class="w-60 aspect-2/3 rounded-xl overflow-hidden shadow-2xl shadow-black/50 border border-surface-dark">
                            <img alt="Kimetsu no Yaiba Poster Art"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                                data-alt="Anime character portrait with sword" src="{{ $anime->poster_url }}" />
                        </div>
                    </div>
                    <div class="flex flex-col gap-6 flex-1 text-center md:text-left">
                        <div class="space-y-2">
                            <h1 class="text-3xl md:text-5xl font-black text-white leading-tight">
                                {{ $anime->title }}
                            </h1>
                            <p class="text-secondary text-lg">
                                {{ $anime->title }}
                            </p>
                        </div>
                        <div class="flex flex-wrap gap-3 justify-center md:justify-start">
                            <span
                                class="px-3 py-1 rounded items-center flex bg-green-500/10 text-green-400 text-xs font-bold border border-green-500/20 uppercase tracking-wider">
                                {{ $anime->status }}
                            </span>
                            <span
                                class="px-3 py-1 rounded flex items-center bg-surface-dark border-surface-border text-white text-xs font-bold border uppercase tracking-wider">
                                {{ $anime->type }}
                            </span>
                            {{-- <span class="px-3 py-1 rounded bg-secondborder-surface-dark text-white text-xs font-bold border border-surface-border uppercase tracking-wider"> --}}
                            {{-- TODO: Adding duration --}}
                            {{-- {{ $anime-> }} --}}
                            {{-- </span> --}}
                            <span
                                class="flex items-center gap-1 px-3 py-1 rounded bg-yellow-500/10 text-yellow-400 text-xs font-bold border border-yellow-500/20">
                                <span class="material-symbols-outlined text-[14px] fill-current">star</span>
                                {{ $anime->rating }}
                            </span>
                        </div>
                        <div class="flex flex-wrap gap-2 justify-center md:justify-start">
                            @foreach ($anime->genres as $genre)
                                <livewire:partials.badge :tagName="$genre->name" />
                            @endforeach
                        </div>
                        <div class="flex flex-wrap gap-4 mt-2 justify-center md:justify-start">
                            <button
                                class="flex items-center gap-2 h-12 px-8 bg-primary hover:bg-blue-600 rounded-lg text-white font-bold transition-all shadow-lg shadow-blue-900/40">
                                <span class="material-symbols-outlined">download</span>
                                <span>Download Batch</span>
                            </button>
                            <button
                                class="flex items-center gap-2 h-12 px-4 md:px-10 bg-secondborder-surface-dark hover:bg-[#323b67] rounded-lg text-white font-bold transition-all border border-surface-border">
                                <span class="material-symbols-outlined">play_arrow</span>
                                <span>Watch Trailer</span>
                            </button>
                            <button
                                class="flex items-center justify-center size-12 bg-secondborder-surface-dark hover:bg-[#323b67] rounded-lg text-white transition-all border border-surface-border">
                                <span class="material-symbols-outlined">bookmark_border</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full max-w-7xl px-4 md:px-10 pb-20 grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-8 space-y-8">
                <section class="bg-surface-dark rounded-xl p-6 border border-surface-dark">
                    <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                        <span class="w-1 h-6 bg-primary rounded-full"></span>
                        Synopsis
                    </h3>
                    <div class="text-secondary leading-relaxed space-y-4">
                        <p>
                            {!! $anime->synopsis !!}
                        </p>
                    </div>
                </section>
                <section class="bg-surface-dark rounded-xl p-6 border border-surface-dark">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6 gap-4">
                        <h3 class="text-xl font-bold text-white flex items-center gap-2">
                            <span class="w-1 h-6 bg-primary rounded-full"></span>
                            Episode List
                        </h3>
                        <div class="relative w-full sm:w-72">
                            <div
                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-secondary">
                                <span class="material-symbols-outlined text-[20px]">search</span>
                            </div>
                            <input
                                class="w-full bg-[#111422] border border-surface-dark rounded-lg py-2.5 pl-10 pr-4 text-white text-sm placeholder:text-secondary focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none transition-all"
                                placeholder="Search episode..." type="text" />
                        </div>
                    </div>
                    <div class="flex flex-col gap-3">
                        @foreach ($latestEpisodes as $episode)
                            <a class="group flex gap-4 bg-[#111422] p-2 rounded-lg border border-surface-dark hover:border-primary/50 transition-all items-center"
                                href="{{ route('pages.episodes.show', [$anime->slug, $episode->number]) }}">
                                <div
                                    class="relative w-32 aspect-video shrink-0 rounded overflow-hidden bg-surface-darker">
                                    <img alt="Ep 1 Thumbnail"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                        src="{{ $episode->thumbnail_url }}" />
                                    <div
                                        class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <span class="material-symbols-outlined text-white text-[24px]">play_arrow</span>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-primary text-xs font-bold">Ep {{ $episode->number }}</span>
                                        @if ($episode->release_date)
                                            <span class="text-secondary text-xs">•</span>
                                            <span
                                                class="text-secondary text-xs">{{ $episode->release_date->diffForHumans() }}</span>
                                        @endif
                                    </div>
                                    <h4
                                        class="text-white text-sm font-medium truncate group-hover:text-primary transition-colors">
                                        {{ $episode->title }}
                                    </h4>
                                </div>
                                <div class="hidden sm:flex px-4 md:px-10">
                                    <span
                                        class="material-symbols-outlined text-secondary group-hover:text-white transition-colors">download</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <button
                        class="w-full mt-6 py-3 bg-[#111422] border border-surface-dark hover:bg-secondborder-surface-dark text-secondary hover:text-white rounded-lg text-sm font-bold transition-colors">
                        Show All Episodes
                    </button>
                </section>
                <section class="bg-surface-dark rounded-xl p-6 border border-surface-dark">
                    <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                        <span class="w-1 h-6 bg-primary rounded-full"></span>
                        Community Reviews
                    </h3>
                    <div class="flex gap-4 mb-8">
                        <div
                            class="size-10 rounded-full bg-primary/20 flex items-center justify-center text-primary font-bold">
                            U
                        </div>
                        <div class="flex-1">
                            <textarea
                                class="w-full bg-[#111422] border border-surface-dark rounded-lg p-3 text-white text-sm focus:ring-1 focus:ring-primary focus:border-primary focus:outline-none transition-all resize-none h-24"
                                placeholder="Write a review..."></textarea>
                            <div class="flex justify-end mt-2">
                                <button
                                    class="px-4 md:px-10 py-2 bg-primary text-white text-sm font-bold rounded-lg hover:bg-blue-600 transition-colors">Post
                                    Review</button>
                            </div>
                        </div>
                    </div>

                </section>
            </div>
            <div class="lg:col-span-4 space-y-8">
                <div class="bg-surface-dark rounded-xl p-6 border border-surface-dark sticky top-24">
                    <h3 class="text-lg font-bold text-white mb-4">Information</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-surface-dark last:border-0">
                            <span class="text-secondary text-sm">Type</span>
                            <span class="text-white text-sm font-medium">{{ $anime->type }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-surface-dark last:border-0">
                            <span class="text-secondary text-sm">Episodes</span>
                            <span class="text-white text-sm font-medium">{{ $anime->episodes->count() }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-surface-dark last:border-0">
                            <span class="text-secondary text-sm">Status</span>
                            <span class="text-white text-sm font-medium">{{ $anime->status->name }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-surface-dark last:border-0">
                            <span class="text-secondary text-sm">Aired</span>
                            <span
                                class="text-white text-sm font-medium">{{ $anime->release_date->diffForHumans() }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-surface-dark last:border-0">
                            <span class="text-secondary text-sm">Studio</span>
                            <span class="text-white text-sm font-medium">
                                @forelse ($anime->studios as $studio)
                                    <span key="{{ $studio->id }}">
                                        {{ $studio->name }}@if (! $loop->last),@endif
                                    </span>
                                @empty
                                    -
                                @endforelse
                            </span>
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-white mt-8 mb-4">Related Anime</h3>
                    <div class="space-y-4">
                        {{-- <a class="flex gap-3 group" href="#">
                            <div class="w-16 h-24 rounded-lg overflow-hidden shrink-0">
                                <img alt="Jujutsu Kaisen cover"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform"
                                    data-alt="Anime boy with pink hair"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCx2SYYYwLaIhZHBPavjdAHIp9BWqjQdVYLHZ4M35t-r0YNLDP2p4V409EztgSRbNG0hdBiQ1oWnu9bLfMBdjD_kmoaC3Qm-RIIfsxgH_laiAfbBXTHdAqLRwZeU4pGPx8G6UkjWtA8jb7oRHyQvkZqK3XG6r65jazivfdSPpU3ATqYGC4bmiZ1j2z7PLpGFRzKHf9qgLNVoAJnfTjfxV-Hxdtzi-Ebyhpj9f2JtXefecJh5NmcmU9-my50cr0jbOXWHVnhpg5OlJX6" />
                            </div>
                            <div class="flex flex-col justify-center">
                                <h4
                                    class="text-white text-sm font-medium leading-tight group-hover:text-primary transition-colors line-clamp-2">
                                    Jujutsu Kaisen Season 2</h4>
                                <span class="text-secondary text-xs mt-1">TV • 2023</span>
                                <div class="flex items-center gap-1 mt-1 text-yellow-400 text-xs font-bold">
                                    <span class="material-symbols-outlined text-[12px] fill-current">star</span> 8.9
                                </div>
                            </div>
                        </a> --}}
                    </div>
                </div>
            </div>
        </div>
    </main>
    <livewire:layouts.footer />
</div>
