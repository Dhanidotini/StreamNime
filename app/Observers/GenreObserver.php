<?php

namespace App\Observers;

use App\Models\Genre;

class GenreObserver
{
    private function clearCache(): void
    {
        cache()->forget('genre.all');
    }

    /**
     * Handle the Genre "created" event.
     */
    public function created(Genre $genre): void
    {
        $this->clearCache();
    }

    /**
     * Handle the Genre "updated" event.
     */
    public function updated(Genre $genre): void
    {
        $this->clearCache();
    }

    /**
     * Handle the Genre "deleted" event.
     */
    public function deleted(Genre $genre): void
    {
        $this->clearCache();
    }

    /**
     * Handle the Genre "restored" event.
     */
    public function restored(Genre $genre): void
    {
        $this->clearCache();
    }

    /**
     * Handle the Genre "force deleted" event.
     */
    public function forceDeleted(Genre $genre): void
    {
        $this->clearCache();
    }
}
