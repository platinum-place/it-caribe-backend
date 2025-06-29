<?php

namespace App\Policies;

use App\Enums\Action;
use App\Enums\Model;
use App\Models\User;

class UserPolicy
{
    /**
     * Perform pre-authorization checks.
     */
    public function before(User $user, string $ability): ?bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(combine_permissions(Model::USER, Action::VIEW_ANY));
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return $user->hasPermissionTo(combine_permissions(Model::USER, Action::VIEW));
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo(combine_permissions(Model::USER, Action::CREATE));
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return $user->hasPermissionTo(combine_permissions(Model::USER, Action::UPDATE));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->hasPermissionTo(combine_permissions(Model::USER, Action::DELETE));
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return $user->hasPermissionTo(combine_permissions(Model::USER, Action::RESTORE));
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return $user->hasPermissionTo(combine_permissions(Model::USER, Action::FORCE_DELETE));
    }
}
