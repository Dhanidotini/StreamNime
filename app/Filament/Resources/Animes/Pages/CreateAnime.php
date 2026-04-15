<?php

namespace App\Filament\Resources\Animes\Pages;

use App\Filament\Resources\Animes\AnimeResource;
use App\Traits\HandleImageImports;
use Filament\Resources\Pages\CreateRecord;

class CreateAnime extends CreateRecord
{
    use HandleImageImports;

    protected static string $resource = AnimeResource::class;

    protected function afterCreate(): void
    {
        $this->processImageImport();
    }
}
