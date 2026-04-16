<?php

namespace App\Filament\Resources\Animes\RelationManagers;

use App\Filament\Resources\Animes\AnimeResource;
use App\Filament\Resources\Episodes\EpisodeResource;
use App\Filament\Resources\Episodes\Schemas\EpisodeForm;
use App\Filament\Resources\Episodes\Tables\EpisodesTable;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class EpisodesRelationManager extends RelationManager
{
    protected static string $relationship = 'episodes';
    protected static string $resource = AnimeResource::class;
    protected static ?string $relatedResource = EpisodeResource::class;

    public function form(Schema $schema): Schema
    {
        return EpisodeForm::configure($schema);
    }

    public function table(Table $table): Table
    {
        return EpisodesTable::configure($table)
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
