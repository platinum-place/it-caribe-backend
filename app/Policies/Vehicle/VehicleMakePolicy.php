<?php

namespace App\Policies\Vehicle;

use App\Enums\Action;
use App\Enums\Model;
use App\Models\User;
use App\Models\Vehicle\VehicleMake;
use Illuminate\Auth\Access\Response;

class VehicleMakePolicy
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
        return $user->hasPermissionTo(combine_permissions(Model::VEHICLE_MAKE, Action::VIEW_ANY));
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, VehicleMake $vehicleMake): bool
    {
        return $user->hasPermissionTo(combine_permissions(Model::VEHICLE_MAKE, Action::VIEW));
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo(combine_permissions(Model::VEHICLE_MAKE, Action::CREATE));
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, VehicleMake $vehicleMake): bool
    {
        return $user->hasPermissionTo(combine_permissions(Model::VEHICLE_MAKE, Action::UPDATE));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, VehicleMake $vehicleMake): bool
    {
        return $user->hasPermissionTo(combine_permissions(Model::VEHICLE_MAKE, Action::DELETE));
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, VehicleMake $vehicleMake): bool
    {
        return $user->hasPermissionTo(combine_permissions(Model::VEHICLE_MAKE, Action::RESTORE));
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, VehicleMake $vehicleMake): bool
    {
        return $user->hasPermissionTo(combine_permissions(Model::VEHICLE_MAKE, Action::FORCE_DELETE));
    }
}
