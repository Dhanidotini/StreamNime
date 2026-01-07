<?php

namespace App\Observers;

use App\Cache\CachedMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaObserver
{
    /**
     * Handle the Media "created" event.
     *
     * @param  \App\Models\Media  $media
     * @return void
     */
    public function created(Media $media)
    {
        CachedMedia::forget($media->model_type, $media->model_id);
    }

    /**
     * Handle the Media "updated" event.
     *
     * @param  \App\Models\Media  $media
     * @return void
     */
    public function updated(Media $media)
    {
        CachedMedia::forget($media->model_type, $media->model_id);
    }

    /**
     * Handle the Media "deleted" event.
     *
     * @param  \App\Models\Media  $media
     * @return void
     */
    public function deleted(Media $media)
    {
        CachedMedia::forget($media->model_type, $media->model_id);
    }

    /**
     * Handle the Media "restored" event.
     *
     * @param  \App\Models\Media  $media
     * @return void
     */
    public function restored(Media $media)
    {
        CachedMedia::forget($media->model_type, $media->model_id);
    }

    /**
     * Handle the Media "force deleted" event.
     *
     * @param  \App\Models\Media  $media
     * @return void
     */
    public function forceDeleted(Media $media)
    {
        CachedMedia::forget($media->model_type, $media->model_id);
    }
}
