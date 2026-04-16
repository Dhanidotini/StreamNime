<?php

namespace App\Filament\Resources\Animes\Schemas;

use Filament\Schemas\Schema;
use App\Enums\Anime\StatusEnum;
use App\Enums\Enums\Anime\TypeEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;

class AnimeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Images')
                    ->tabs([
                        Tab::make('Poster')
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('posters')
                                    ->collection('posters')
                                    ->visibility('public')
                                    ->image()
                                    ->openable()
                                    ->moveFiles(),
                                TextInput::make('poster_image_url')
                                    ->label('Upload poster image from Url')
                                    ->url()
                                    ->dehydrated(false),
                            ]),
                        Tab::make('Banner')
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
                                    ->dehydrated(false),
                            ])
                    ]),
                Section::make('Main Information')
                    ->columns(1)
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(?string $state, Set $set) => (
                                $set('slug', str()->slug($state))
                            )),
                        TextInput::make('slug')
                            ->required(),
                        Toggle::make('is_trending')
                            ->onColor('primary')
                            ->live(),
                    ]),
                Section::make('Additional Information')
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        Select::make('status')
                            ->required()
                            ->native(false)
                            ->options(StatusEnum::class)
                            ->selectablePlaceholder(false)
                            ->live(true)
                            ->default('draft'),
                        DateTimePicker::make('release_date')
                            ->format('Y-m-d H:i:s')
                            ->displayFormat('Y-m-d H:i:s')
                            ->native(true)
                            ->required()
                            ->live(true)
                            ->default(now('Asia/Jakarta')),
                        TextInput::make('rating')
                            ->numeric()
                            ->default(null),
                        Select::make('type')
                            ->native(false)
                            ->options(TypeEnum::class)
                            ->selectablePlaceholder(false)
                            ->required()
                            ->default('Unknown'),
                        Select::make('Genres')
                            ->multiple()
                            ->relationship('genres', 'name')
                            ->preload(),
                        Select::make('Studios')
                            ->multiple()
                            ->relationship('studios', 'name')
                            ->preload()
                    ]),
                RichEditor::make('synopsis')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
