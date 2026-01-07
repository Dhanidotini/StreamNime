<?php

namespace App\View\Composer;

use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;
use App\Models\Genre;

class GenreComposer
{
    public function compose(View $view)
    {
        $genres = Cache::rememberForever(
            'genre.all',
            fn() =>
            Genre::orderBy('name')
            ->limit(6)
            ->get()
        );

        $view->with('genres', $genres);
    }
}
