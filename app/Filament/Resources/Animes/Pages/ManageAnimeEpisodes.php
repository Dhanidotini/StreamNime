<?php

namespace App\Filament\Resources\Animes\Pages;

use App\Filament\Resources\Animes\AnimeResource;
use App\Filament\Resources\Episodes\EpisodeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables\Table;

class ManageAnimeEpisodes extends ManageRelatedRecords
{
    protected static string $resource = AnimeResource::class;

    protected static string $relationship = 'episodes';

    protected static ?string $relatedResource = EpisodeResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
