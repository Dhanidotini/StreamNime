<?php

namespace App\Providers;

use App\Models\Genre;
use App\Observers\GenreObserver;
use App\View\Composer\GenreComposer;
use Filament\Support\Facades\FilamentTimezone;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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

        if (app()->environment('production')) {
            URL::forceScheme('https');

            // Memaksa state request menjadi secure secara manual
            request()->server->set('HTTPS', 'on');
        } else {
            URL::forceScheme('http');
        }
    }
}
