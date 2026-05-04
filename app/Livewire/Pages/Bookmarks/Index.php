<?php

namespace App\Livewire\Pages\Bookmarks;

use App\Models\Bookmark;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render(): View
    {
        $bookmarks = Bookmark::query()
            ->where('user_id', Auth::id())
            ->with(['anime.genres', 'anime.episodes', 'anime.media'])
            ->latest()
            ->paginate(20);

        return view('livewire.pages.bookmarks.index', [
            'bookmarks' => $bookmarks,
        ]);
    }
}
