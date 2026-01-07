<?php

namespace App\Livewire\Layouts;

use Livewire\Component;

class Navbar extends Component
{
    public function render()
    {
        $navbars = [
            'pages.anime-list' => 'Anime List',
        ];
        return view('livewire.layouts.navbar', compact('navbars'));
    }
}
