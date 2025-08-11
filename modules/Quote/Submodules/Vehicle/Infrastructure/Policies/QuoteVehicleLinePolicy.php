<?php

namespace Modules\Quote\Submodules\Vehicle\Infrastructure\Policies;

use App\Models\User;
use Modules\Quote\Submodules\Vehicle\Infrastructure\Persistence\Models\QuoteVehicleLine;

class QuoteVehicleLinePolicy
{
    /**
     * Perform pre-authorization checks.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->isAdmin()) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, QuoteVehicleLine $quoteVehicleLine): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, QuoteVehicleLine $quoteVehicleLine): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, QuoteVehicleLine $quoteVehicleLine): bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, QuoteVehicleLine $quoteVehicleLine): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, QuoteVehicleLine $quoteVehicleLine): bool
    {
        return true;
    }
}
