<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function permissions(User $user, $permission)
    {
        return $user->permissions()->where('name', $permission)->exists();
    }

    public function editAdmin(User $user, User $userEdit)
    {
        return $userEdit->id != 1 || $user->id == 1;
    }

    public function deleteAdmin(User $user, User $userDelete)
    {
        return $userDelete->id != 1;
    }

    public function deleteUser(User $user, User $userDelete)
    {
        return $user->id != $userDelete->id;
    }
}
