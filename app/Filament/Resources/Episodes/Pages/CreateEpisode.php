<?php

namespace App\Filament\Resources\Episodes\Pages;

use App\Filament\Resources\Episodes\EpisodeResource;
use App\Traits\HandleImageImports;
use Filament\Resources\Pages\CreateRecord;

class CreateEpisode extends CreateRecord
{
    use HandleImageImports;

    protected static string $resource = EpisodeResource::class;

    protected function afterCreate(): void
    {
        $this->processImageImport();
    }
}
