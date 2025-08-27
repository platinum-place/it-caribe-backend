<?php

namespace App\Observers\Vehicle;

use App\Models\Vehicle\VehicleUse;
use App\Observers\Common\BaseObserver;

class VehicleUseObserver extends BaseObserver
{
    /**
     * Handle the VehicleUse "created" event.
     */
    public function created(VehicleUse $vehicleUse): void
    {
        //
    }

    /**
     * Handle the VehicleUse "updated" event.
     */
    public function updated(VehicleUse $vehicleUse): void
    {
        //
    }

    /**
     * Handle the VehicleUse "deleted" event.
     */
    public function deleted(VehicleUse $vehicleUse): void
    {
        //
    }

    /**
     * Handle the VehicleUse "restored" event.
     */
    public function restored(VehicleUse $vehicleUse): void
    {
        //
    }

    /**
     * Handle the VehicleUse "force deleted" event.
     */
    public function forceDeleted(VehicleUse $vehicleUse): void
    {
        //
    }
}
