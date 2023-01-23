<?php

namespace App\Policies;

use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class StudentPolicy
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
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Student $student
     * @return Response|bool
     */
    public function view(User $user, Student $student)
    {
        return ($user->role === "admin" && $user->admin !== null) ||
            ($user->role === "professor" && $user->professor !== null) ||
            $user->id === $student->user->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user)
    {
        return ($user->role === "admin" && $user->admin !== null) ||
            ($user->role === "professor" && $user->professor !== null);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Student $student
     * @return Response|bool
     */
    public function update(User $user, Student $student)
    {
        return ($user->role === "admin" && $user->admin !== null) ||
            ($user->role === "professor" && $user->professor !== null) ||
            $user->id === $student->user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Student $student
     * @return Response|bool
     */
    public function delete(User $user, Student $student)
    {
        return $user->role === "admin" && $user->admin !== null;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Student $student
     * @return Response|bool
     */
    public function restore(User $user, Student $student)
    {
        return $user->role === "admin" && $user->admin !== null;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Student $student
     * @return Response|bool
     */
    public function forceDelete(User $user)
    {
        return $user->role === "admin" && $user->admin !== null;
    }
}
