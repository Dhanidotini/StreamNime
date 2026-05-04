<?php

namespace App\Filament\Resources\Bookmarks\Pages;

use App\Filament\Resources\Bookmarks\BookmarkResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBookmark extends CreateRecord
{
    protected static string $resource = BookmarkResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $superAdminRole = config('filament-shield.super_admin.name', 'super_admin');

        if (! auth()->user()?->hasRole($superAdminRole)) {
            $data['user_id'] = auth()->id();
        }

        return $data;
    }
}
