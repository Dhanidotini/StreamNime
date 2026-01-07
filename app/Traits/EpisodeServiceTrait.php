<?php

namespace App\Traits;

use App\Models\Episode;

trait EpisodeServiceTrait
{
    protected function getLatestEpisodesAnime(int $limit = 4)
    {
        return Episode::query()
            ->with(['media', 'anime'])
            ->limit($limit)
            ->orderByDesc('release_date')
            ->get();
    }
}
