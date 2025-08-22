<?php

namespace App\Observers\Vehicle;

use App\Models\Vehicle\Vehicle;

class VehicleObserver
{
    public function creating(Vehicle $vehicle): void
    {
        if(!$vehicle->vehicle_type_id){
            $vehicle->vehicle_type_id = $vehicle->vehicleModel->vehicle_type_id;
        }
    }

    /**
     * Handle the Vehicle "created" event.
     */
    public function created(Vehicle $vehicle): void
    {
        //
    }

    /**
     * Handle the Vehicle "updated" event.
     */
    public function updated(Vehicle $vehicle): void
    {
        //
    }

    /**
     * Handle the Vehicle "deleted" event.
     */
    public function deleted(Vehicle $vehicle): void
    {
        //
    }

    /**
     * Handle the Vehicle "restored" event.
     */
    public function restored(Vehicle $vehicle): void
    {
        //
    }

    /**
     * Handle the Vehicle "force deleted" event.
     */
    public function forceDeleted(Vehicle $vehicle): void
    {
        //
    }
}
