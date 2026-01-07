<?php

namespace App\Livewire\Partials;

use Livewire\Component;

class Badge extends Component
{
    public $tagName, $href;
    public function render()
    {
        return view('livewire.partials.badge');
    }
}
