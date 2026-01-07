<?php

namespace App\Filament\Resources\Genres\Schemas;

use Illuminate\Support\Str;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;

class GenreForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->afterStateUpdated(fn (string $state, Set $set) => (
                        $set('slug', Str::slug($state))
                    ))
                    ->live(onBlur: true),
                TextInput::make('slug')
                    ->required(),
            ]);
    }
}
