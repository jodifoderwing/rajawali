<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Layangukur;
use Illuminate\Auth\Access\HandlesAuthorization;

class LayangukurPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_layangukur');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Layangukur $layangukur): bool
    {
        return $user->can('view_layangukur');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_layangukur');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Layangukur $layangukur): bool
    {
        return $user->can('update_layangukur');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Layangukur $layangukur): bool
    {
        return $user->can('delete_layangukur');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_layangukur');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Layangukur $layangukur): bool
    {
        return $user->can('force_delete_layangukur');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_layangukur');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Layangukur $layangukur): bool
    {
        return $user->can('restore_layangukur');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_layangukur');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Layangukur $layangukur): bool
    {
        return $user->can('replicate_layangukur');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_layangukur');
    }
}
