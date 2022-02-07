<?php

namespace App\Policies;

use App\Models\Storage;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StoragePolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list storages');
    }


    public function view(User $user, Storage $storage)
    {
        return $user->hasPermissionTo('list storages');
    }


    public function create(User $user)
    {
        return $user->hasPermissionTo('add storages');
    }


    public function update(User $user, Storage $storage)
    {
        return $user->hasPermissionTo('edit storages') or $storage->user->id === $user->id;
    }


    public function delete(User $user, Storage $storage)
    {
        return $user->hasPermissionTo('delete storages');
    }


    public function restore(User $user, Storage $storage)
    {
        return $user->hasPermissionTo('delete storages');
    }


    public function forceDelete(User $user, Storage $storage)
    {
        return $user->hasPermissionTo('delete storages');
    }
}
