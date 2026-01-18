<?php

namespace App\Filament\Resources\Studios\Schemas;

use Illuminate\Support\Str;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;

class StudioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->afterStateUpdated(fn(string $state, Set $set) => (
                        $set('slug', Str::slug($state))
                    ))
                    ->live(onBlur: true),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('synonyms')
                    ->default(null),
                TextInput::make('native')
                    ->default(null),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
