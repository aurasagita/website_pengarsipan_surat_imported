<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Kategorisurat;
use Illuminate\Auth\Access\HandlesAuthorization;

class KategorisuratPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the kategorisurat can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the kategorisurat can view the model.
     */
    public function view(User $user, Kategorisurat $model): bool
    {
        return true;
    }

    /**
     * Determine whether the kategorisurat can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the kategorisurat can update the model.
     */
    public function update(User $user, Kategorisurat $model): bool
    {
        return true;
    }

    /**
     * Determine whether the kategorisurat can delete the model.
     */
    public function delete(User $user, Kategorisurat $model): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the kategorisurat can restore the model.
     */
    public function restore(User $user, Kategorisurat $model): bool
    {
        return false;
    }

    /**
     * Determine whether the kategorisurat can permanently delete the model.
     */
    public function forceDelete(User $user, Kategorisurat $model): bool
    {
        return false;
    }
}
