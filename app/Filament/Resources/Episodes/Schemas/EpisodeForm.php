<?php

namespace App\Filament\Resources\Episodes\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EpisodeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('banners')
                            ->collection('banners')
                            ->visibility('public')
                            ->image()
                            ->openable()
                            ->moveFiles(),
                        TextInput::make('banner_image_url')
                            ->label('Upload banners image from Url')
                            ->url()
                            ->dehydrated(false)
                    ]),
                Section::make()
                    ->schema([
                        TextInput::make('title')
                            ->default(null),
                        TextInput::make('number')
                            ->required()
                            ->numeric(),
                    ]),
                DateTimePicker::make('release_date'),
                TextInput::make('video_url')
                    ->prefixIcon('heroicon-o-globe-alt'),
            ]);
    }
}
