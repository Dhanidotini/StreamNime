<?php

namespace App\Filament\Resources\Animes\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Animes\AnimeResource;
use App\Filament\Resources\Animes\Pages\ManageAnimeEpisodes;

class ListAnimes extends ListRecords
{
    protected static string $resource = AnimeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
