<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->role === "admin" &&
            $user->isNotBanned() &&
            $user->admin->is_owner;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Admin $admin
     * @return Response|bool
     */
    public function view(User $user, Admin $admin)
    {
        return $user->role === "admin" &&
            $user->isNotBanned() &&
            ($user->admin->is_owner || $user->id === $admin->user->id);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user)
    {
        return $user->role === "admin" &&
            $user->isNotBanned() &&
            $user->admin->is_owner;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Admin $admin
     * @return Response|bool
     */
    public function update(User $user, Admin $admin)
    {
        return $user->role === "admin" &&
            $user->isNotBanned() &&
            ($user->admin->is_owner || $user->id === $admin->user->id);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Admin $admin
     * @return Response|bool
     */
    public function delete(User $user, Admin $admin)
    {
        return $user->role === "admin" &&
            $user->isNotBanned() &&
            $user->admin->is_owner;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Admin $admin
     * @return Response|bool
     */
    public function restore(User $user, Admin $admin)
    {
        return $user->role === "admin" &&
            $user->isNotBanned() &&
            $user->admin->is_owner;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @return Response|bool
     */
    public function forceDelete(User $user)
    {
        return $user->role === "admin" &&
            $user->isNotBanned() &&
            $user->admin->is_owner;
    }
}
