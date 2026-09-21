<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Bookmark;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookmarkPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Bookmark');
    }

    public function view(AuthUser $authUser, Bookmark $bookmark): bool
    {
        return $authUser->can('View:Bookmark');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Bookmark');
    }

    public function update(AuthUser $authUser, Bookmark $bookmark): bool
    {
        return $authUser->can('Update:Bookmark');
    }

    public function delete(AuthUser $authUser, Bookmark $bookmark): bool
    {
        return $authUser->can('Delete:Bookmark');
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