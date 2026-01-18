<?php

namespace App\Providers;

use App\Models\Genre;
use App\Observers\GenreObserver;
use App\Observers\MediaObserver;
use Illuminate\Support\Facades\URL;
use App\View\Composer\GenreComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentTimezone;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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
        Genre::observe(GenreObserver::class);

        FilamentTimezone::set('Asia/Jakarta');

        View::composer('livewire.layouts.genres', GenreComposer::class);

        if (config('app.env') !== 'local') {
            URL::forceScheme('https');

            // Memaksa state request menjadi secure secara manual
            request()->server->set('HTTPS', 'on');
        }
    }
}
