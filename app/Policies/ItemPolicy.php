<?php

namespace App\Policies;

use App\Models\Item;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemPolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list items');
    }


    public function view(User $user, Item $item): bool
    {
        return $user->hasPermissionTo('list items') or $user->id === $item->storage->user->id;
    }


    public function create(User $user): bool
    {
        return $user->hasPermissionTo('add items');
    }


    public function update(User $user, Item $item): bool
    {
        return $user->hasPermissionTo('edit items') or $user->id === $item->storage->user->id;
    }


    public function delete(User $user, Item $item): bool
    {
        return $user->hasPermissionTo('delete items') or $user->id === $item->storage->user->id;
    }


    public function restore(User $user, Item $item): bool
    {
        return $user->hasPermissionTo('delete items');
    }


    public function forceDelete(User $user, Item $item): bool
    {
        return $user->hasPermissionTo('delete items') or $user->id === $item->storage->user->id;
    }
}
