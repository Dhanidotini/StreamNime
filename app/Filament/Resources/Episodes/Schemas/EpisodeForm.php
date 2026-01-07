<?php

namespace App\Filament\Resources\Episodes\Schemas;

use DateTime;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EpisodeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                SpatieMediaLibraryFileUpload::make('posters')
                    ->collection('images')
                    ->image()
                    ->openable()
                    ->moveFiles(),
                TextInput::make('title')
                    ->default(null),
                DateTimePicker::make('release_date'),
                TextInput::make('video_url')
                ->prefixIcon('heroicon-o-globe-alt'),
                TextInput::make('number')
                    ->required()
                    ->numeric(),

                // TODO: Add released_date

                Select::make('anime_id')
                    // ->disabledOn()
                    ->relationship('anime', 'title')
                    ->required(),
            ]);
    }
}
