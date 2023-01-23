<?php

namespace App\Policies;

use App\Models\Field;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class FieldPolicy
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
     * @param Field $field
     * @return Response|bool
     */
    public function view(User $user, Field $field)
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
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Field $field
     * @return Response|bool
     */
    public function update(User $user, Field $field)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Field $field
     * @return Response|bool
     */
    public function delete(User $user, Field $field)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Field $field
     * @return Response|bool
     */
    public function restore(User $user, Field $field)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Field $field
     * @return Response|bool
     */
    public function forceDelete(User $user, Field $field)
    {
        return false;
    }
}
