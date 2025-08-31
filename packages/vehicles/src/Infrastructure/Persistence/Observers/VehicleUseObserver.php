<?php

namespace Root\Vehicles\Infrastructure\Persistence\Observers;

use App\Observers\BaseObserver;
use Root\Vehicles\Infrastructure\Persistence\Models\VehicleUse;

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
