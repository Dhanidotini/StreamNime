<?php

namespace App\Filament\Resources\Bookmarks;

use App\Filament\Resources\Bookmarks\Pages\CreateBookmark;
use App\Filament\Resources\Bookmarks\Pages\EditBookmark;
use App\Filament\Resources\Bookmarks\Pages\ListBookmarks;
use App\Filament\Resources\Bookmarks\Schemas\BookmarkForm;
use App\Filament\Resources\Bookmarks\Tables\BookmarksTable;
use App\Models\Bookmark;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class BookmarkResource extends Resource
{
    protected static ?string $model = Bookmark::class;

    protected static ?string $navigationLabel = 'Bookmark';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookmark;

    protected static string|BackedEnum|null $activeNavigationIcon = Heroicon::Bookmark;

    protected static string|UnitEnum|null $navigationGroup = 'Content Management';

    protected static ?string $modelLabel = 'Bookmark';

    protected static ?string $pluralModelLabel = 'Bookmark';

    public static function form(Schema $schema): Schema
    {
        return BookmarkForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BookmarksTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()->with(['user', 'anime']);

        $user = Auth::user();
        $superAdminRole = config('filament-shield.super_admin.name', 'super_admin');

        if ($user && ! $user->hasRole($superAdminRole)) {
            $query->where($query->qualifyColumn('user_id'), $user->id);
        }

        return $query;
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
            'index' => ListBookmarks::route('/'),
            'create' => CreateBookmark::route('/create'),
            'edit' => EditBookmark::route('/{record}/edit'),
        ];
    }
}
