<?php

namespace App\Livewire\Layouts\Animes;

use Livewire\Component;

class Card extends Component
{
    public $anime;
    public function render()
    {
        return view('livewire.layouts.animes.card');
    }
}
