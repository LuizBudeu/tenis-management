<?php

namespace App\Policies;

use App\Models\TennisCourt;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TennisCourtPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;  // Everyone can view tennis courts
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TennisCourt $tennisCourt): bool
    {
        return true;  // Everyone can view tennis courts
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->tokenCan('admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TennisCourt $tennisCourt): bool
    {
        return $user->tokenCan('admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TennisCourt $tennisCourt): bool
    {
        return $user->tokenCan('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TennisCourt $tennisCourt): bool
    {
        return $user->tokenCan('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TennisCourt $tennisCourt): bool
    {
        return $user->tokenCan('admin');
    }
}
