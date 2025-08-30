<?php

namespace Modules\Vehicle\Observers;

use App\Observers\BaseObserver;
use Modules\Vehicle\Models\VehicleAccessory;

class VehicleAccessoryObserver extends BaseObserver
{
    /**
     * Handle the VehicleAccessory "created" event.
     */
    public function created(VehicleAccessory $vehicleAccessory): void
    {
        //
    }

    /**
     * Handle the VehicleAccessory "updated" event.
     */
    public function updated(VehicleAccessory $vehicleAccessory): void
    {
        //
    }

    /**
     * Handle the VehicleAccessory "deleted" event.
     */
    public function deleted(VehicleAccessory $vehicleAccessory): void
    {
        //
    }

    /**
     * Handle the VehicleAccessory "restored" event.
     */
    public function restored(VehicleAccessory $vehicleAccessory): void
    {
        //
    }

    /**
     * Handle the VehicleAccessory "force deleted" event.
     */
    public function forceDeleted(VehicleAccessory $vehicleAccessory): void
    {
        //
    }
}
