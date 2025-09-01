<?php

namespace App\Observers;

use App\Observers\BaseObserver;
use App\Models\QuoteVehicleLine;

class QuoteVehicleLineObserver extends BaseObserver
{
    /**
     * Handle the QuoteVehicleLine "created" event.
     */
    public function created(QuoteVehicleLine $quoteVehicleLine): void
    {
        //
    }

    /**
     * Handle the QuoteVehicleLine "updated" event.
     */
    public function updated(QuoteVehicleLine $quoteVehicleLine): void
    {
        //
    }

    /**
     * Handle the QuoteVehicleLine "deleted" event.
     */
    public function deleted(QuoteVehicleLine $quoteVehicleLine): void
    {
        //
    }

    /**
     * Handle the QuoteVehicleLine "restored" event.
     */
    public function restored(QuoteVehicleLine $quoteVehicleLine): void
    {
        //
    }

    /**
     * Handle the QuoteVehicleLine "force deleted" event.
     */
    public function forceDeleted(QuoteVehicleLine $quoteVehicleLine): void
    {
        //
    }
}
