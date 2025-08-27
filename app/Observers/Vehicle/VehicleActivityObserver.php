<?php

namespace App\Observers\Vehicle;

use App\Models\Vehicle\VehicleActivity;
use App\Observers\Common\BaseObserver;

class VehicleActivityObserver extends BaseObserver
{
    /**
     * Handle the VehicleActivity "created" event.
     */
    public function created(VehicleActivity $vehicleActivity): void
    {
        //
    }

    /**
     * Handle the VehicleActivity "updated" event.
     */
    public function updated(VehicleActivity $vehicleActivity): void
    {
        //
    }

    /**
     * Handle the VehicleActivity "deleted" event.
     */
    public function deleted(VehicleActivity $vehicleActivity): void
    {
        //
    }

    /**
     * Handle the VehicleActivity "restored" event.
     */
    public function restored(VehicleActivity $vehicleActivity): void
    {
        //
    }

    /**
     * Handle the VehicleActivity "force deleted" event.
     */
    public function forceDeleted(VehicleActivity $vehicleActivity): void
    {
        //
    }
}
