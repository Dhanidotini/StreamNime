<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Traits\CacheableAnimeTrait;
use App\Traits\CacheableEpisodeTrait;
use Illuminate\Contracts\View\View;

class Home extends Component
{
    use CacheableAnimeTrait, CacheableEpisodeTrait;

    public $latestEpisode;

    public function mount(): void
    {
        $this->latestEpisode = $this->getLatestEpisodesAnime(4);
    }

    public function goto()
    {
        return redirect()->route('pages.anime-list', ['o' => 'top']);
    }

    public function loadMoreEpisode(int $moreNumber = 4): void
    {
        $episodesCount = $this->latestEpisode->count();
        $newLimit = $episodesCount + $moreNumber;
        $this->latestEpisode = $this->getLatestEpisodesAnime($newLimit);
    }

    public function render(): View
    {
        return view('livewire.pages.home', [
            'publishedAnime' => $this->getAiringAnimeCache(4),
            'completedAnime' => $this->getCompletedAnimeCache(4),
            'trendingAnime' => $this->getTrendingAnimeCache(),
            'latestEpisode' => $this->latestEpisode,
            'popularAnime' => $this->getPopularAnimeCache(),
        ]);
    }
}
