<?php

namespace App\Traits;

use App\Enums\Anime\StatusEnum;

trait HasModelScope
{
    public function getThumbnailUrlAttribute()
    {
        $media = $this->getMedia('images');

        if ($media->isNotEmpty()) {
            return $this->getFirstMediaUrl('images', 'thumbnail');
        }
        return asset('no_image_available.webp');
    }
}
