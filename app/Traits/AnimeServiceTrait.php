<?php

namespace App\Traits;

use App\Models\Anime;
use App\Enums\Anime\StatusEnum;
use Illuminate\Database\Eloquent\Builder;

trait AnimeServiceTrait
{
    private function getLatestAnime(int $limit = 4)
    {
        return Anime::latest()
            ->limit($limit)
            ->get();
    }

    private function getAiringAnime(int $limit = 4)
    {
        return Anime::where('status', StatusEnum::Airing)
            ->with(['episodes', 'media'])
            ->limit($limit)
            ->latest()
            ->get();
    }

    private function getCompletedAnime(int $limit = 4)
    {
        return Anime::where('status', StatusEnum::Completed)
            ->with(['episodes', 'media'])
            ->limit($limit)
            ->latest()
            ->get();
    }

    private function getTrendingAnime(int $limit = 1)
    {
        return Anime::where('is_trending', '=', true)
            ->with(['genres', 'media'])
            ->limit($limit)
            ->first();
    }

    private function getPopularAnime(int $limit = 6)
    {
        return Anime::where('rating', '<=', 10)
            ->with(['genres', 'media'])
            ->orderBy('rating', 'desc')
            ->get();
    }
}
