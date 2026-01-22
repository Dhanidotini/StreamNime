<?php

namespace App\Traits;

trait HasModelScope
{
    public function mediaUrl(string $collection, string $conversion): string
    {
        $media = $this->getFirstMedia($collection);

        if (!$media) {
            return asset('no_image_available.webp');
        }

        return $media->hasGeneratedConversion($conversion)
            ? $media->getUrl($conversion)
            : $media->getUrl();
    }

    public function getBannerUrlAttribute(): string
    {
        return $this->mediaUrl('banners', 'large');
    }

    public function getPosterUrlAttribute(): string
    {
        return $this->mediaUrl('posters', 'medium');
    }
}
