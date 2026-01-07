<?php

namespace App\Livewire\Pages\Animes;

use App\Models\Anime;
use Livewire\Component;

class Show extends Component
{
    public $anime;
    public $latestEpisodes;
    public function mount(Anime $anime)
    {
        $this->anime = $anime->load(['genres', 'media', 'episodes']);
        $this->latestEpisodes = $anime->episodes->sortByDesc('release_date');
    }
    public function render()
    {
        return view('livewire.pages.animes.show');
    }
}
