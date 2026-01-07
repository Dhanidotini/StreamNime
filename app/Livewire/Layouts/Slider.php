<?php

namespace App\Livewire\Layouts;

use Livewire\Component;

class Slider extends Component
{
    public $trendingAnime;
    public function render()
    {
        return view('livewire.layouts.slider');
    }
}
