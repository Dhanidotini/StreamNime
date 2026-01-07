<?php

namespace App\Models;

use App\Models\Genre;
use App\Models\Episode;
use App\Traits\HasModelScope;
use App\Traits\CacheableAnime;
use App\Traits\HasCachedMedia;
use App\Enums\Anime\StatusEnum;
use Spatie\MediaLibrary\HasMedia;
use App\Enums\Enums\Anime\TypeEnum;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Services\MediaLibrary\CustomPathGenerator;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\Support\PathGenerator\PathGeneratorFactory;

class Anime extends Model implements HasMedia
{
    use InteractsWithMedia, HasModelScope;

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

    protected static function booting(): void
    {
        PathGeneratorFactory::setCustomPathGenerators(static::class, CustomPathGenerator::class);
    }

    public function registerMediaCollections(?Media $media = null): void
    {
        $this
            ->addMediaCollection('images')
            ->useDisk('media')
            ->registerMediaConversions(
                function (Media $media) {
                    $this->addMediaConversion('thumbnail')
                        ->format('webp')
                        ->width(500)
                        ->quality(70)
                        ->optimize()
                        ->nonQueued();
                }
            );
        $this
            ->addMediaCollection('trending')
            ->useDisk('media')
            ->registerMediaConversions(
                function (Media $media) {
                    $this->addMediaConversion('thumbnail')
                        ->format('webp')
                        ->width(800)
                        ->quality(80)
                        ->optimize()
                        ->nonQueued();
                }
            );
    }

    public function episodes(): HasMany
    {
        return $this->hasMany(Episode::class);
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }
}
