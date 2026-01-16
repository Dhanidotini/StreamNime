<div>
    <livewire:layouts.navbar />
    <main class="w-full max-w-7xl mx-auto px-4 md:px-10 py-6 flex flex-col gap-6">
        <div class="flex flex-wrap gap-2 items-center text-sm">
            <a class="text-text-secondary hover:text-white transition-colors" href="/">Home</a>
            <span class="text-text-secondary">/</span>
            <span class="text-text-secondary transition-colors">Anime List</span>
            <span class="text-text-secondary">/</span>
            <a class="text-text-secondary hover:text-white transition-colors"
                href="{{ route('pages.animes.show', $anime->slug) }}">{{ $anime->title }}</a>
            <span class="text-text-secondary">/</span>
            <span class="text-primary font-medium">{{ $episode->title }}</span>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-8 flex flex-col gap-6">
                <div class="flex flex-col gap-4">

                    <iframe allowfullscreen borderadius="0"
                        class="relative w-full aspect-video bg-black rounded-xl overflow-hidden shadow-2xl shadow-black/60 group border border-surface-border"
                        src="{{ $episode->abyss_url }}">
                    </iframe>
                    <div
                        class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 p-5 rounded-xl bg-surface-dark border border-surface-border">
                        <div class="flex-1 min-w-0">
                            <h1 class="text-xl md:text-2xl font-bold text-white leading-tight truncate">
                                Episode {{ $episode->number }}: {{ $episode->title }}
                            </h1>
                            <div class="flex flex-wrap items-center gap-3 mt-2">
                                <a wire:navigate class="text-primary text-sm font-semibold hover:underline"
                                    href="{{ route('pages.animes.show', $anime->slug) }}">
                                    {{ $anime->title }}
                                </a>
                                @if ($episode->release_date)
                                    <span class="text-text-secondary text-xs">•</span>
                                    <span
                                        class="text-text-secondary text-xs">{{ $episode->release_date->diffForHumans() }}</span>
                                @endif
                                <span
                                    class="px-2 py-0.5 rounded bg-surface-border text-text-secondary text-xxs font-bold uppercase tracking-wider ">{{ $anime->status }}</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 w-full md:w-auto shrink-0">
                            <button wire:click="prev" wire:navigate @if ($this->firstNumber() == $episode->number) disabled @endif
                                @class([
                                    'flex-1 md:flex-none h-10 px-4 flex items-center justify-center gap-2 rounded-lg bg-primary text-white hover:bg-primary-hover hover:shadow-lg hover:shadow-primary/25 transition-all text-sm font-bold group',
                                    'disabled:cursor-not-allowed disabled:bg-surface-light disabled:text-text-secondary disabled:hover:shadow-none' =>
                                        $episode->firstNumber == $episode->number,
                                ])>
                                <span
                                    class="material-symbols-outlined text-[18px] group-disabled:translate-x-0 group-hover:-translate-x-1 transition-transform">arrow_back</span>
                                Prev
                            </button>

                            <button wire:click="next" @if ($episode->lastNumber == $episode->number) disabled @endif
                                @class([
                                    'flex-1 md:flex-none h-10 px-4 flex items-center justify-center gap-2 rounded-lg bg-primary text-white hover:bg-primary-hover hover:shadow-lg hover:shadow-primary/25 transition-all text-sm font-bold group',
                                    'disabled:cursor-not-allowed disabled:bg-surface-light disabled:text-text-secondary disabled:hover:shadow-none font-semibold' =>
                                        $episode->lastNumber,
                                ])>
                                Next
                                <span
                                    class="material-symbols-outlined text-[18px] group-disabled:translate-x-0 group-hover:translate-x-1 transition-transform">arrow_forward</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center gap-2 border-b border-surface-border pb-2">
                            <span class="material-symbols-outlined text-primary">info</span>
                            <h3 class="text-lg font-bold">Synopsis</h3>
                        </div>
                        <div
                            class="bg-surface-dark p-5 rounded-xl border border-surface-border h-full [&_p]:text-text-secondary [&_p]:text-sm [&_p]:leading-relaxed [&_p]:mb-4">
                            {!! str($anime->synopsis)->words(38) !!}

                            <div class="flex flex-wrap gap-2">
                                @foreach ($anime->genres as $genre)
                                    <a class="px-3 py-1 rounded-full bg-surface-light border border-surface-border text-xs text-text-secondary hover:text-white hover:border-primary transition-colors"
                                        href="#">
                                        {{ $genre->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center gap-2 border-b border-surface-border pb-2">
                            <span class="material-symbols-outlined text-primary">download</span>
                            <h3 class="text-lg font-bold">Download</h3>
                        </div>
                        <div class="flex flex-col gap-2">
                            <div
                                class="flex items-center justify-between p-3 rounded-lg bg-surface-light border border-surface-border hover:border-text-muted transition-colors group">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="size-9 rounded bg-surface-border text-white flex items-center justify-center text-xs font-bold shadow-inner">
                                        FHD
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-white">1080p</span>
                                        <span class="text-[10px] text-text-secondary">MKV • 450MB</span>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <a class="px-3 py-1.5 rounded text-xs font-bold bg-surface-border text-white hover:bg-primary transition-colors"
                                        href="#">GDrive</a>
                                    <a class="px-3 py-1.5 rounded text-xs font-bold bg-surface-border text-white hover:bg-primary transition-colors"
                                        href="#">Mega</a>
                                </div>
                            </div>
                            <div
                                class="flex items-center justify-between p-3 rounded-lg bg-surface-light border border-surface-border hover:border-text-muted transition-colors group">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="size-9 rounded bg-surface-border text-text-secondary group-hover:text-white flex items-center justify-center text-xs font-bold transition-colors shadow-inner">
                                        HD
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-white">720p</span>
                                        <span class="text-[10px] text-text-secondary">MP4 • 220MB</span>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <a class="px-3 py-1.5 rounded text-xs font-bold bg-surface-border text-white hover:bg-primary transition-colors"
                                        href="#">GDrive</a>
                                    <a class="px-3 py-1.5 rounded text-xs font-bold bg-surface-border text-white hover:bg-primary transition-colors"
                                        href="#">Mega</a>
                                </div>
                            </div>
                            <div
                                class="flex items-center justify-between p-3 rounded-lg bg-surface-light border border-surface-border hover:border-text-muted transition-colors group">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="size-9 rounded bg-surface-border text-text-muted group-hover:text-white flex items-center justify-center text-xs font-bold transition-colors shadow-inner">
                                        SD
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-white">480p</span>
                                        <span class="text-[10px] text-text-secondary">MP4 • 110MB</span>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <a class="px-3 py-1.5 rounded text-xs font-bold bg-surface-border text-white hover:bg-primary transition-colors"
                                        href="#">GDrive</a>
                                    <a class="px-3 py-1.5 rounded text-xs font-bold bg-surface-border text-white hover:bg-primary transition-colors"
                                        href="#">Mega</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 flex flex-col gap-6">
                <div
                    class="bg-surface-dark rounded-xl border border-surface-border overflow-hidden flex flex-col h-fit sticky top-24">
                    <div class="flex items-center justify-between p-4 border-b border-surface-border bg-surface-light">
                        <div>
                            <h3 class="text-white font-bold text-sm uppercase tracking-wider">
                                Up Next
                            </h3>
                            <p class="text-text-muted text-xs mt-0.5">Season 1</p>
                        </div>
                        <div class="flex gap-1">
                            <button class="p-1 hover:bg-surface-border rounded text-text-secondary transition-colors">
                                <span class="material-symbols-outlined text-[20px]">sort</span>
                            </button>
                        </div>
                    </div>
                    <div class="flex flex-col max-h-125 overflow-y-auto custom-scrollbar p-2 gap-1">
                        @foreach ($anime->episodes as $allEpisode)
                            <a href="{{ route('pages.episodes.show', [$anime->slug, $allEpisode->number]) }}"
                                wire:navigate @class([
                                    'flex gap-3 p-2 rounded-lg hover:bg-surface-light border border-transparent hover:border-surface-border cursor-pointer transition-all group',
                                    'bg-primary/20 border border-primary/30' =>
                                        $allEpisode->number == $episode->number,
                                ])>
                                <div class="w-28 h-16 rounded overflow-hidden shrink-0 relative">
                                    <img @class([
                                        'w-full h-full object-cover',
                                        'opacity-60' => $episode->number == $allEpisode->number,
                                    ]) alt="Ep {{ $allEpisode->number }}"
                                        src="{{ $allEpisode->thumbnail_url }}" />
                                    @if ($episode->number == $allEpisode->number)
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <div
                                                class="size-6 bg-primary rounded-full flex items-center justify-center shadow-lg">
                                                <span
                                                    class="material-symbols-outlined text-white text-[16px]">equalizer</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex flex-col justify-center min-w-0">
                                    <div class="flex gap-1">
                                        @if ($allEpisode->number == $episode->number)
                                            <span
                                                class="text-primary text-[10px] font-bold uppercase tracking-wider mb-0.5">
                                                Playing
                                            </span>
                                        @endif
                                        <span @class([
                                            'text-text-secondary text-[10px] font-bold uppercase tracking-wider mb-0.5 group-hover:text-primary transition-colors',
                                            'group-hover:text-white' => $allEpisode->number == $allEpisode->number,
                                        ])>
                                            Episode {{ $allEpisode->number }}
                                        </span>
                                    </div>
                                    <h4 @class([
                                        'text-text-secondary group-hover:text-white text-sm font-medium truncate transition-colors',
                                        'text-white font-bold' => $allEpisode->number == $episode->number,
                                    ])>
                                        {{ $allEpisode->title }}
                                    </h4>
                                    @if ($allEpisode->release_date)
                                        <span
                                            class="text-text-secondary text-xs">{{ $allEpisode->release_date->diffForHumans() }}</span>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
    <livewire:layouts.footer />
</div>
