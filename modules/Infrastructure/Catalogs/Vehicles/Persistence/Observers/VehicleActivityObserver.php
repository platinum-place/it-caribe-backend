<?php

namespace Modules\Infrastructure\Catalogs\Vehicles\Persistence\Observers;

use App\Observers\BaseObserver;
use Modules\Infrastructure\Catalogs\Vehicles\Persistence\Models\VehicleActivity;

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
