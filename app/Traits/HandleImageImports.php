<?php

namespace App\Traits;

use App\Jobs\DownloadImageFromUrl;

trait HandleImageImports
{
    /**
     * Universal logic for importing immage using Queue
     */
    protected function processImageImport()
    {
        $posterUrl = $this->data['poster_image_url'] ?? null;
        $bannerUrl = $this->data['banner_image_url'] ?? null;

        if ($posterUrl && filter_var($posterUrl, FILTER_VALIDATE_URL)) {
            DownloadImageFromUrl::dispatch($this->record, $posterUrl, 'posters');
        }

        if ($bannerUrl && filter_var($bannerUrl, FILTER_VALIDATE_URL)) {
            DownloadImageFromUrl::dispatch($this->record, $bannerUrl, 'banners');
        }
    }
}
