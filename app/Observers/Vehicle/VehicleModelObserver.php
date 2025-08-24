<?php

namespace App\Observers\Vehicle;

use App\Models\Vehicle\VehicleModel;
use App\Observers\BaseObserver;

class VehicleModelObserver extends BaseObserver
{
    /**
     * Handle the VehicleModel "created" event.
     */
    public function created(VehicleModel $vehicleModel): void
    {
        //
    }

    /**
     * Handle the VehicleModel "updated" event.
     */
    public function updated(VehicleModel $vehicleModel): void
    {
        //
    }

    /**
     * Handle the VehicleModel "deleted" event.
     */
    public function deleted(VehicleModel $vehicleModel): void
    {
        //
    }

    /**
     * Handle the VehicleModel "restored" event.
     */
    public function restored(VehicleModel $vehicleModel): void
    {
        //
    }

    /**
     * Handle the VehicleModel "force deleted" event.
     */
    public function forceDeleted(VehicleModel $vehicleModel): void
    {
        //
    }
}
