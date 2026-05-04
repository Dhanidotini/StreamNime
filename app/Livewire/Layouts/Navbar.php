<?php

namespace App\Livewire\Layouts;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Navbar extends Component
{
    use WithPagination;

    public function render()
    {
        $navbars = [
            'pages.anime-list' => 'Anime List',
        ];

        $rightNavbars = [];
        if (Auth::check()) {
            $rightNavbars['pages.bookmarks'] = 'Bookmark';
            $rightNavbars['filament.dashboard.pages.dashboard'] = 'Dashboard';
        } else {
            $rightNavbars['filament.dashboard.auth.login'] = 'Login';
            $rightNavbars['filament.dashboard.auth.register'] = 'Register';
        }

        return view('livewire.layouts.navbar', compact(['navbars', 'rightNavbars']));
    }
}
