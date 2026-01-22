<a class="group relative block overflow-hidden rounded-xl bg-surface-hover"
    href="{{ route('pages.animes.show', $anime) }}" wire:navigate>
    <div class="relative aspect-3/4 w-full overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110"
                style="background-image: url('{{ $anime->poster_url }}')">
        </div>
        <div class="absolute inset-0 bg-linear-to-t from-black/80 via-transparent to-transparent">
        </div>
        <div class="absolute top-2 left-2 flex gap-1 justify-center items-center">
            <span @class([
                'rounded px-2 py-0.5 text-xxs font-bold text-white uppercase tracking-wider',
                'bg-sky-600' => $anime->status->value === 'airing',
                'bg-emerald-500' => $anime->status->value === 'completed',
            ])>{{ $anime->status }}</span>
        </div>
        <div class="absolute top-2 right-2 flex gap-1">
            <span @class([
                'rounded px-2 py-0.5 text-xxs font-bold text-white uppercase tracking-wider',
                'bg-purple-600' => $anime->type->value === 'TV',
                'bg-yellow-600' => $anime->type->value === 'Movie',
                'bg-pink-600' => $anime->type->value === 'OVA',
                'bg-red-600' => $anime->type->value === 'ONA',
                'bg-gray-600' => $anime->type->value === 'Music',
            ])>
                {{ $anime->type }}
            </span>
        </div>
        <div class="absolute bottom-0 left-0 right-0 p-3">
            <h3 class="text-sm font-bold text-white group-hover:text-primary line-clamp-2 transition-colors">
                {{ $anime->title }}
            </h3>
            <p class="mt-1 text-xxs text-gray-400">
                {{ isset($anime->episodes) ? 'Episode ' . count($anime->episodes) . ' • ' : '' }}
                {{ $anime->release_date->diffForHumans() }}</p>
        </div>
    </div>
</a>
