<?php

namespace App\Policies;

use App\Models\Defense;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class DefensePolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     *
     * @param User $user
     * @param string $ability
     * @return void|bool
     */
    public function before(User $user, $ability)
    {
        if ($user->role === "admin" && $user->admin !== null) {
            return true;
        }
        return null;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Defense $defense
     * @return Response|bool
     */
    public function view(User $user, Defense $defense)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Defense $defense
     * @return Response|bool
     */
    public function update(User $user, Defense $defense)
    {
        return $user->id === $defense->creator_id ||
            $user->id === $defense->professor->user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Defense $defense
     * @return Response|bool
     */
    public function delete(User $user, Defense $defense)
    {
        return $user->id === $defense->creator_id ||
            $user->id === $defense->professor->user->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Defense $defense
     * @return Response|bool
     */
    public function restore(User $user, Defense $defense)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Defense $defense
     * @return Response|bool
     */
    public function forceDelete(User $user, Defense $defense)
    {
        return $user->id === $defense->creator_id ||
            $user->id === $defense->professor->user->id;
    }
}
