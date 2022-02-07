<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list users');
    }


    public function view(User $user, User $model): bool
    {
        return $user->hasPermissionTo('list users');
    }


    public function create(User $user): bool
    {
        return $user->hasPermissionTo('add users');
    }


    public function update(User $user, User $model): bool
    {
        return $user->hasPermissionTo('edit users') or $user->id === $model->id;
    }


    public function delete(User $user, User $model): bool
    {
        return $user->hasPermissionTo('delete users') or $user->id === $model->id;
    }


    public function restore(User $user, User $model): bool
    {
        return $user->hasPermissionTo('delete users');
    }


    public function forceDelete(User $user, User $model): bool
    {
        return $user->hasPermissionTo('delete users') or $user->id === $model->id;
    }
}
