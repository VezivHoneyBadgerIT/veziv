<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vezivhour;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class VezivhourPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Vezivhour $vezivhour): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Vezivhour $vezivhour): bool
    {
        return Auth::check();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Vezivhour $vezivhour): bool
    {
        return Auth::check();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Vezivhour $vezivhour): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Vezivhour $vezivhour): bool
    {
        //
    }
}
