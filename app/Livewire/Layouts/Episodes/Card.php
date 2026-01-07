<?php

namespace App\Livewire\Layouts\Episodes;

use Livewire\Component;

class Card extends Component
{
    public $episode;
    public function render()
    {
        return view('livewire.layouts.episodes.card');
    }
}
