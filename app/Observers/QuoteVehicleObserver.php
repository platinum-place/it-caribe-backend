<?php

namespace App\Observers;

use App\Observers\BaseObserver;
use App\Models\QuoteVehicle;

class QuoteVehicleObserver extends BaseObserver
{
    /**
     * Handle the QuoteVehicle "created" event.
     */
    public function created(QuoteVehicle $quoteVehicle): void
    {
        //
    }

    /**
     * Handle the QuoteVehicle "updated" event.
     */
    public function updated(QuoteVehicle $quoteVehicle): void
    {
        //
    }

    /**
     * Handle the QuoteVehicle "deleted" event.
     */
    public function deleted(QuoteVehicle $quoteVehicle): void
    {
        //
    }

    /**
     * Handle the QuoteVehicle "restored" event.
     */
    public function restored(QuoteVehicle $quoteVehicle): void
    {
        //
    }

    /**
     * Handle the QuoteVehicle "force deleted" event.
     */
    public function forceDeleted(QuoteVehicle $quoteVehicle): void
    {
        //
    }
}
