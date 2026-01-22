<?php

namespace App\Services\MediaLibrary;

use App\Models\Anime;
use App\Models\Episode;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class CustomPathGenerator implements PathGenerator
{
    public function getPath(Media $media): string
    {
        return $this->getBasePath($media) . '/';
    }

    public function getPathForConversions(Media $media): string
    {
        return $this->getBasePath($media) . '/resized/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getBasePath($media) . '/responsive-images/';
    }

    protected function getBasePath(Media $media): string
    {
        $model = $media->model;

        if ($model instanceof Anime) {
            return "animes/{$model->slug}/{$media->collection_name}/{$media->uuid}";
        }

        if ($model instanceof Episode) {

            // relation episode to anime
            $animeSlug = $model->anime->slug ?? "unknown";
            return "animes/{$animeSlug}/episodes/{$model->number}/{$media->uuid}";
        }

        return "others/{$media->uuid}";
    }
}
