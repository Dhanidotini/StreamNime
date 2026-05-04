<?php

namespace App\Livewire\Pages\Animes;

use App\Models\Anime;
use App\Models\Episode;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Show extends Component
{
    public Anime $anime;

    /** @var Collection<int, Episode> */
    public $latestEpisodes;

    public bool $isBookmarked = false;

    public function mount(Anime $anime): void
    {
        $this->anime = $anime->load(['genres', 'media', 'episodes']);
        $this->latestEpisodes = $anime->episodes->sortByDesc('release_date');

        if (Auth::check()) {
            $this->isBookmarked = Auth::user()->bookmark()->whereKey($anime->getKey())->exists();
        }
    }

    public function toggleBookmark()
    {
        if (! Auth::check()) {
            session()->put('url.intended', route('pages.animes.show', $this->anime));

            return $this->redirect(route('filament.dashboard.auth.login'), false);
        }

        $result = Auth::user()->bookmark()->toggle([$this->anime->getKey()]);
        $this->isBookmarked = count($result['attached']) > 0;
    }

    public function render(): View
    {
        return view('livewire.pages.animes.show');
    }
}
