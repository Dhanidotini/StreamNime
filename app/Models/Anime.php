<?php

namespace App\Models;

use App\Models\Genre;
use App\Models\Episode;
use App\Traits\HasModelScope;
use App\Enums\Anime\StatusEnum;
use Spatie\MediaLibrary\HasMedia;
use App\Enums\Enums\Anime\TypeEnum;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasStandardImageConversions;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Anime extends Model implements HasMedia
{
    use InteractsWithMedia, HasModelScope, SoftDeletes, HasStandardImageConversions {
        HasStandardImageConversions::registerMediaConversions insteadof InteractsWithMedia;
    }

    // Media Collection
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('posters');
        $this->addMediaCollection('banners');
    }

    protected $fillable = [
        'title',
        'slug',
        'synopsis',
        'status',
        'release_date',
        'rating',
        'type',
        'is_trending'
    ];

    protected $casts = [
        'is_trending' => 'boolean',
        'release_date' => 'datetime:Y-m-d H:i:s',
        'status' => StatusEnum::class,
        'type' => TypeEnum::class
    ];

    public function episodes(): HasMany
    {
        return $this->hasMany(Episode::class);
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    // Belongs to many Studio tables
    public function studios(): BelongsToMany
    {
        return $this->belongsToMany(Studio::class);
    }
}
