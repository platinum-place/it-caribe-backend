<?php

namespace App\Observers\Vehicle;

use App\Models\Vehicle\Vehicle;
use App\Observers\Common\BaseObserver;

class VehicleObserver extends BaseObserver
{
    public function creating(Vehicle|\Illuminate\Database\Eloquent\Model $model): void
    {
        parent::creating($model);

        if (! $model->vehicle_type_id) {
            $model->vehicle_type_id = $model->vehicleModel->vehicle_type_id;
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
