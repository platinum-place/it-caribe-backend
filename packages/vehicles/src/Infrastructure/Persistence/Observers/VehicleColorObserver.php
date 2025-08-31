<?php

namespace Root\Vehicles\Infrastructure\Persistence\Observers;

use App\Observers\BaseObserver;
use Root\Vehicles\Infrastructure\Persistence\Models\VehicleColor;

class VehicleColorObserver extends BaseObserver
{
    /**
     * Handle the VehicleColor "created" event.
     */
    public function created(VehicleColor $vehicleColor): void
    {
        //
    }

    /**
     * Handle the VehicleColor "updated" event.
     */
    public function updated(VehicleColor $vehicleColor): void
    {
        //
    }

    /**
     * Handle the VehicleColor "deleted" event.
     */
    public function deleted(VehicleColor $vehicleColor): void
    {
        //
    }

    /**
     * Handle the VehicleColor "restored" event.
     */
    public function restored(VehicleColor $vehicleColor): void
    {
        //
    }

    /**
     * Handle the VehicleColor "force deleted" event.
     */
    public function forceDeleted(VehicleColor $vehicleColor): void
    {
        //
    }
}
