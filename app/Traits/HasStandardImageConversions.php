<?php

namespace App\Traits;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait HasStandardImageConversions
{
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('large')
            ->format('webp')
            ->width(1200)
            ->optimize()
            ->queued();
        $this->addMediaConversion('medium')
            ->format('webp')
            ->width(400)
            ->quality(80)
            ->sharpen(5)
            ->optimize()
            ->queued();
        $this->addMediaConversion('small')
            ->format('webp')
            ->width(150)
            ->height(150)
            ->quality(85)
            ->sharpen(10)
            ->optimize()
            ->queued();
    }
}
