<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait CacheableEpisodeTrait
{
    use EpisodeServiceTrait;

    protected function getLatestEpisodeCache(
        int $limit = 4,
        array $ttl = [60, 3600]
    ): mixed {
        return Cache::flexible(
            'episode.latest',
            $ttl,
            fn() => $this->getLatestEpisodesAnime($limit)
        );
    }
}
