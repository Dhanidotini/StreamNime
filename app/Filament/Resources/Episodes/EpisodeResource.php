<?php

namespace App\Filament\Resources\Episodes;

use BackedEnum;
use App\Models\Episode;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use App\Filament\Resources\Animes\AnimeResource;
use App\Filament\Resources\Episodes\Pages\EditEpisode;
use App\Filament\Resources\Episodes\Pages\ListEpisodes;
use App\Filament\Resources\Episodes\Pages\CreateEpisode;
use App\Filament\Resources\Episodes\Schemas\EpisodeForm;
use App\Filament\Resources\Episodes\Tables\EpisodesTable;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;
use UnitEnum;

class EpisodeResource extends Resource
{
    protected static ?string $model = Episode::class;
    protected static ?string $recordTitleAttribute = 'title';
    protected static ?string $navigationParentItem = 'Animes';
    protected static string|UnitEnum|null $navigationGroup = 'Anime Management';

    public static function form(Schema $schema): Schema
    {
        return EpisodeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EpisodesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEpisodes::route('/'),
            'create' => CreateEpisode::route('/create'),
            'edit' => EditEpisode::route('/{record}/edit'),
        ];
    }
}
