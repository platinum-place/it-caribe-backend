<?php

namespace Modules\Vehicle\Observers;

use App\Observers\Common\BaseObserver;
use Modules\Vehicle\Models\VehicleLoanType;

class VehicleLoanTypeObserver extends BaseObserver
{
    /**
     * Handle the VehicleLoanType "created" event.
     */
    public function created(VehicleLoanType $vehicleLoanType): void
    {
        //
    }

    /**
     * Handle the VehicleLoanType "updated" event.
     */
    public function updated(VehicleLoanType $vehicleLoanType): void
    {
        //
    }

    /**
     * Handle the VehicleLoanType "deleted" event.
     */
    public function deleted(VehicleLoanType $vehicleLoanType): void
    {
        //
    }

    /**
     * Handle the VehicleLoanType "restored" event.
     */
    public function restored(VehicleLoanType $vehicleLoanType): void
    {
        //
    }

    /**
     * Handle the VehicleLoanType "force deleted" event.
     */
    public function forceDeleted(VehicleLoanType $vehicleLoanType): void
    {
        //
    }
}
