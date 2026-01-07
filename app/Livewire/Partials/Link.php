<?php

namespace App\Livewire\Partials;

use Livewire\Component;

class Link extends Component
{
    public $title = 'Button';
    public $href, $logo, $class;

    public function render()
    {
        return view('livewire.partials.link');
    }
}
