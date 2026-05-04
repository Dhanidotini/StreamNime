<?php

namespace App\Filament\Resources\Bookmarks\Tables;

use App\Models\Bookmark;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class BookmarksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('anime.title')
                    ->label('Anime')
                    ->searchable()
                    ->sortable()
                    ->url(fn (Bookmark $record): ?string => $record->anime?->slug ? route('pages.animes.show', $record->anime->slug) : null)
                    ->openUrlInNewTab(),
                TextColumn::make('user.name')
                    ->label('Pengguna')
                    ->searchable()
                    ->sortable()
                    ->visible(fn (): bool => Auth::user()?->hasRole(config('filament-shield.super_admin.name', 'super_admin')) ?? false),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('view')
                    ->label('View')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->url(fn (Bookmark $record): ?string => $record->anime?->slug ? route('pages.animes.show', $record->anime->slug) : null)
                    ->openUrlInNewTab(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
