<section>
    <div class="mb-4 flex items-center justify-between">
        <h2 class="text-2xl font-bold tracking-tight text-white">Browse by Genre</h2>
        <a class="text-sm font-medium text-primary hover:text-blue-400" href="{{ route('pages.anime-list') }}">View All</a>
    </div>
    <div class="flex flex-wrap gap-3">

        @forelse ($genres as $genre)
            <livewire:partials.badge :tagName="$genre->name" :href="route('pages.anime-list', ['g[0]' => $genre->id])" />
        @empty
            Not Have
        @endforelse
        {{-- <a class="rounded-full bg-primary px-4 py-2 text-sm font-medium text-white shadow-lg shadow-primary/25"
            href="#">Isekai</a> --}}
    </div>
</section>
