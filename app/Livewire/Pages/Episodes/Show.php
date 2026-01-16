<?php

namespace App\Livewire\Pages\Episodes;

use livewire;
use App\Models\Anime;
use App\Models\Episode;
use Livewire\Component;
use Livewire\Livewire as LivewireAlias;

class Show extends Component
{
    public Anime $anime;
    public ?Episode $episode;
    public $firstNumber;
    public function firstNumber()
    {
        return $this->anime->episodes->first()->number == $this->episode->number;
    }
    public function mount(Anime $anime, Episode $episode)
    {
        $this->anime = $anime->load('episodes');
        $this->episode = $episode->load('anime');
    }

    public function next()
    {
        return $this->redirect(route('pages.episodes.show', [$this->anime->slug, $this->episode->number + 1]), true);
    }
    public function prev()
    {
        return $this->redirect(route('pages.episodes.show', [$this->anime->slug, $this->episode->number - 1]), true);
    }

    public function render()
    {
        return view('livewire.pages.episodes.show');
    }
}
