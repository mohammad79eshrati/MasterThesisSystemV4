<?php

namespace App\Policies;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class SubjectPolicy
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
     * @param Subject $subject
     * @return Response|bool
     */
    public function view(User $user, Subject $subject)
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
        return $user->role === "professor" && $user->professor !== null;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Subject $subject
     * @return Response|bool
     */
    public function update(User $user, Subject $subject)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Subject $subject
     * @return Response|bool
     */
    public function delete(User $user, Subject $subject)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Subject $subject
     * @return Response|bool
     */
    public function restore(User $user, Subject $subject)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Subject $subject
     * @return Response|bool
     */
    public function forceDelete(User $user, Subject $subject)
    {
        return false;
    }
}
