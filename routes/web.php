<?php

use App\Livewire\Pages\Animelist;
use App\Livewire\Pages\Animes;
use App\Livewire\Pages\Bookmarks\Index as BookmarksIndex;
use App\Livewire\Pages\Episodes;
use App\Livewire\Pages\Home;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)
    ->name('pages.home');

Route::get('/animes/{anime:slug}', Animes\Show::class)
    ->name('pages.animes.show');

Route::redirect('/animes/{anime:slug}/episode', '/animes/{anime:slug}');
Route::get('/animes/{anime:slug}/episode/{episode:number?}', Episodes\Show::class)
    ->name('pages.episodes.show');

Route::get('/anime-list', Animelist::class)
    ->name('pages.anime-list');

Route::get('/bookmarks', BookmarksIndex::class)
    ->middleware('auth')
    ->name('pages.bookmarks');
