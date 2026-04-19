<?php

namespace App\Providers;

use App\Models\Genre;
use App\Observers\GenreObserver;
use Illuminate\Support\Facades\URL;
use App\View\Composer\GenreComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentTimezone;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // watch what gonna happen while with genre
        Genre::observe(GenreObserver::class);

        // Set timezone for Filament
        FilamentTimezone::set('Asia/Jakarta');

        // Data of genres to be asscessable from anywhere
        View::composer('livewire.layouts.genres', GenreComposer::class);

        $isLocal = request()->getHost() === 'localhost' || request()->getHost() === '127.0.0.1';
        if (app()->environment('production') || app()->environment('staging')) {
            if (!$isLocal) {
                URL::forceScheme('https');
            } else {
                URL::forceScheme('http');
            }
        }
    }
}
