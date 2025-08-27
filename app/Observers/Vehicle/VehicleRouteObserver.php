<?php

namespace App\Observers\Vehicle;

use App\Models\Vehicle\VehicleRoute;
use App\Observers\Common\BaseObserver;

class VehicleRouteObserver extends BaseObserver
{
    /**
     * Handle the VehicleRoute "created" event.
     */
    public function created(VehicleRoute $vehicleRoute): void
    {
        //
    }

    /**
     * Handle the VehicleRoute "updated" event.
     */
    public function updated(VehicleRoute $vehicleRoute): void
    {
        //
    }

    /**
     * Handle the VehicleRoute "deleted" event.
     */
    public function deleted(VehicleRoute $vehicleRoute): void
    {
        //
    }

    /**
     * Handle the VehicleRoute "restored" event.
     */
    public function restored(VehicleRoute $vehicleRoute): void
    {
        //
    }

    /**
     * Handle the VehicleRoute "force deleted" event.
     */
    public function forceDeleted(VehicleRoute $vehicleRoute): void
    {
        //
    }
}
