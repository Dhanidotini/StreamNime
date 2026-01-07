<?php

namespace App\Traits;

use App\Traits\AnimeServiceTrait;
use Illuminate\Support\Facades\Cache;

trait CacheableAnimeTrait
{
    use AnimeServiceTrait;

    protected function getAiringAnimeCache(
        int $limit = 4,
        array $ttl = [60, 3600]
    ) {
        return Cache::flexible(
            'anime.published',
            $ttl,
            fn() => $this->getAiringAnime($limit)
        );
    }

    protected function getCompletedAnimeCache(
        int $limit = 4,
        array $ttl = [60, 3600]
    ) {
        return Cache::flexible(
            'anime.completed',
            $ttl,
            fn() => $this->getCompletedAnime($limit)
        );
    }

    protected function getTrendingAnimeCache(
        int $limit = 1,
        array $ttl = [60, 3600]
    )
    {
        return Cache::flexible(
            'anime.trending',
            $ttl,
            fn() => $this->getTrendingAnime($limit)
        );
    }

    protected function getPopularAnimeCache(
        int $limit = 6,
        array $ttl = [1800, 3600] // [30 minute, 1 hours]
    ) {
        return Cache::flexible(
            'anime.popular',
            $ttl,
            fn() => $this->getPopularAnime($limit)
        );
    }
}
