<?php

namespace App\Filament\Resources\Animes\Schemas;

use App\Enums\Anime\StatusEnum;
use App\Enums\Enums\Anime\TypeEnum;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class AnimeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Poster Upload Method')
                    ->tabs([
                        Tab::make('Poster Upload')
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('posters')
                                    ->name('')
                                    ->collection('posters')
                                    ->visibility('public')
                                    ->image()
                                    ->openable()
                                    ->moveFiles(),
                            ]),
                        Tab::make('URL Import')
                            ->schema([
                                TextInput::make('poster_image_url')
                                    ->label('Paste URL')
                                    ->url()
                                    ->dehydrated(false),
                            ]),
                    ]),
                Tabs::make('Banner Upload Method')
                    ->tabs([
                        Tab::make('Banner Upload')
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('banners')
                                    ->name('')
                                    ->collection('banners')
                                    ->visibility('public')
                                    ->image()
                                    ->openable()
                                    ->moveFiles(),
                            ]),
                        Tab::make('URL Import')
                            ->schema([
                                TextInput::make('banner_image_url')
                                    ->label('Paste URL')
                                    ->url()
                                    ->dehydrated(false),
                            ]),
                    ]),
                Section::make('Main Information')
                    ->columns(1)
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (?string $state, Set $set) => (
                                $set('slug', str()->slug($state))
                            )),
                        TextInput::make('slug')
                            ->required(),
                        Select::make('status')
                            ->required()
                            ->native(false)
                            ->options(StatusEnum::class)
                            ->selectablePlaceholder(false)
                            ->live(true)
                            ->default('draft'),
                        DatePicker::make('release_date')
                            ->format('Y-m-d H:i:s')
                            ->displayFormat('Y-m-d')
                            ->placeholder(now())
                            ->native(true)
                            ->live(true),
                        TextInput::make('rating')
                            ->numeric()
                            ->default(null),
                    ]),
                Section::make('Additional Information')
                    ->schema([
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
                            ->preload(),
                        Toggle::make('is_trending')
                            ->onColor('primary')
                            ->live(),
                    ]),
                RichEditor::make('synopsis')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
