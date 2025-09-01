<?php

namespace App\Observers;

use App\Models\VehicleUtility;

class VehicleUtilityObserver extends BaseObserver
{
    /**
     * Handle the VehicleUtility "created" event.
     */
    public function created(VehicleUtility $vehicleUtility): void
    {
        //
    }

    /**
     * Handle the VehicleUtility "updated" event.
     */
    public function updated(VehicleUtility $vehicleUtility): void
    {
        //
    }

    /**
     * Handle the VehicleUtility "deleted" event.
     */
    public function deleted(VehicleUtility $vehicleUtility): void
    {
        //
    }

    /**
     * Handle the VehicleUtility "restored" event.
     */
    public function restored(VehicleUtility $vehicleUtility): void
    {
        //
    }

    /**
     * Handle the VehicleUtility "force deleted" event.
     */
    public function forceDeleted(VehicleUtility $vehicleUtility): void
    {
        //
    }
}
