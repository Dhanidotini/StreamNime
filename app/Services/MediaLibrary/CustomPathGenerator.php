<?php

namespace App\Services\MediaLibrary;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class CustomPathGenerator implements PathGenerator
{
    private function customPath(Media $media): string
    {
        return md5($media->id . config('app.key'));
    }

    public function getPath(Media $media): string
    {
        return $this->customPath($media) . '/';
    }

    public function getPathForConversions(Media $media): string
    {
        return $this->customPath($media). '/size/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->customPath($media) . '/responsive-images/';
    }
}
