<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Bookmark;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class BookmarkPolicy
{
    use HandlesAuthorization;

    protected function isSuperAdmin(AuthUser $authUser): bool
    {
        $role = config('filament-shield.super_admin.name', 'super_admin');

        return method_exists($authUser, 'hasRole') && $authUser->hasRole($role);
    }

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Bookmark');
    }

    public function view(AuthUser $authUser, Bookmark $bookmark): bool
    {
        if (! $authUser->can('View:Bookmark')) {
            return false;
        }

        return $this->isSuperAdmin($authUser) || $bookmark->user_id === $authUser->id;
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Bookmark');
    }

    public function update(AuthUser $authUser, Bookmark $bookmark): bool
    {
        if (! $authUser->can('Update:Bookmark')) {
            return false;
        }

        return $this->isSuperAdmin($authUser) || $bookmark->user_id === $authUser->id;
    }

    public function delete(AuthUser $authUser, Bookmark $bookmark): bool
    {
        if (! $authUser->can('Delete:Bookmark')) {
            return false;
        }

        return $this->isSuperAdmin($authUser) || $bookmark->user_id === $authUser->id;
    }

    public function restore(AuthUser $authUser, Bookmark $bookmark): bool
    {
        return $authUser->can('Restore:Bookmark');
    }

    public function forceDelete(AuthUser $authUser, Bookmark $bookmark): bool
    {
        return $authUser->can('ForceDelete:Bookmark');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Bookmark');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Bookmark');
    }

    public function replicate(AuthUser $authUser, Bookmark $bookmark): bool
    {
        return $authUser->can('Replicate:Bookmark');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Bookmark');
    }
}
