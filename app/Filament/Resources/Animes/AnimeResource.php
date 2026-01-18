<?php

namespace App\Filament\Resources\Animes;

use UnitEnum;
use BackedEnum;
use App\Models\Anime;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Resources\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Route;
use App\Filament\Resources\Animes\Pages\EditAnime;
use App\Filament\Resources\Animes\Pages\ListAnimes;
use App\Filament\Resources\Animes\Pages\CreateAnime;
use App\Filament\Resources\Animes\Schemas\AnimeForm;
use App\Filament\Resources\Animes\Tables\AnimesTable;
use App\Filament\Resources\Episodes\Pages\CreateEpisode;
use App\Filament\Resources\Animes\Pages\ManageAnimeEpisodes;
use App\Filament\Resources\Animes\RelationManagers\EpisodesRelationManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AnimeResource extends Resource
{
    protected static ?string $model = Anime::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|BackedEnum|null $activeNavigationIcon = Heroicon::RectangleStack;
    protected static string|UnitEnum|null $navigationGroup = 'Anime Management';
    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return AnimeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AnimesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            EpisodesRelationManager::class,
        ];
    }
    public static function getPages(): array
    {
        return [
            'index' => ListAnimes::route('/'),
            'create' => CreateAnime::route('/create'),
            'edit' => EditAnime::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
        ->withoutGlobalScopes([
            SoftDeletingScope::class,
        ]);
    }
}
