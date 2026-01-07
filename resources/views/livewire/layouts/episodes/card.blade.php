<a class="group relative flex flex-col gap-3"
    href="{{ route('pages.episodes.show', [$episode->anime->slug, $episode->number]) }}">
    <div class="relative aspect-video w-full overflow-hidden rounded-xl bg-surface-hover">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110"
            data-alt="Anime character looking at sky with futuristic city background"
            style="background-image: url('{{ $episode->thumbnail_url }}');">
        </div>
        <div
            class="absolute inset-0 bg-linear-to-t from-black/80 via-transparent to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100">
        </div>
        <div
            class="absolute bottom-2 left-2 right-2 flex justify-between items-end opacity-0 transform translate-y-2 transition-all duration-300 group-hover:opacity-100 group-hover:translate-y-0">
            <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-primary text-white">
                <span class="material-symbols-outlined text-[20px]">play_arrow</span>
            </span>
        </div>
        <div
            class="absolute top-2 left-2 rounded-md bg-black/60 px-2 py-1 text-xs font-bold text-white backdrop-blur-sm">
            EP {{ $episode->number }}</div>
    </div>
    <div>
        <h3
            class="text-base font-bold leading-tight text-white group-hover:text-primary transition-colors line-clamp-2">
            {{ $episode->title }}
        </h3>
        <span class="text-xs mt-1">{{ $episode->anime->title }}</span>
        <p class="text-xs text-gray-400">
            {{ $episode->release_date->diffForHumans() }}
        </p>
    </div>
</a>
