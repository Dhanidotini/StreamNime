<?php

namespace App\Models;

use App\Traits\HasModelScope;
use App\Traits\HasStandardImageConversions;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Episode extends Model implements HasMedia
{
    use InteractsWithMedia, HasModelScope, SoftDeletes, HasStandardImageConversions {
        HasStandardImageConversions::registerMediaConversions insteadof InteractsWithMedia;
    }

    public function registerMediaCollections(?Media $media = null): void
    {
        $this->addMediaCollection('banners');
    }

    public function getAbyssUrlAttribute()
    {
        return env('VIDEO_PREFIX', 'https://short.icu/').$this->video_url;
    }


    protected $fillable = [
        'title',
        'number',
        'video_url',
        'release_date',
        'anime_id',
    ];

    protected $casts = [
        'release_date' => 'datetime:Y-m-d H:i:s',
    ];

    public function anime(): BelongsTo
    {
        return $this->belongsTo(Anime::class);
    }
}
