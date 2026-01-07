<?php

namespace App\Filament\Resources\Animes\Schemas;

use DateTime;
use Filament\Schemas\Schema;
use App\Enums\Anime\StatusEnum;
use App\Enums\Enums\Anime\TypeEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Fieldset;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class AnimeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                SpatieMediaLibraryFileUpload::make('posters')
                    ->collection('images')
                    ->openable()
                    ->image()
                    ->moveFiles(),
                SpatieMediaLibraryFileUpload::make('banners')
                    ->collection('trending')
                    ->image()
                    ->openable()
                    ->moveFiles()
                    ->live()
                    ->required(),
                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(?string $state, Set $set) => (
                        $set('slug', str()->slug($state))
                    )),
                TextInput::make('slug')
                    ->required(),
                RichEditor::make('synopsis')
                    ->default(null)
                    ->columnSpanFull(),
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

                Fieldset::make('Additional Information')
                    ->columns(2)
                    ->schema([
                        Select::make('Genres')
                            ->multiple()
                            ->relationship('genres', 'name')
                            ->preload()
                    ]),
                Toggle::make('is_trending')
                    ->live(),
            ]);
    }
}
