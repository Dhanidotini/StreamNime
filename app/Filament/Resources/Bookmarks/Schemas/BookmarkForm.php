<?php

namespace App\Filament\Resources\Bookmarks\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class BookmarkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required(fn (): bool => auth()->user()?->hasRole(config('filament-shield.super_admin.name', 'super_admin')) ?? false)
                    ->visible(fn (): bool => auth()->user()?->hasRole(config('filament-shield.super_admin.name', 'super_admin')) ?? false),
                Select::make('anime_id')
                    ->relationship('anime', 'title')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }
}
