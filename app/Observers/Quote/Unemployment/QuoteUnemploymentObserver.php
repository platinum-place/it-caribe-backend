<?php

namespace App\Observers\Quote\Unemployment;

use App\Models\Quote\Unemployment\QuoteUnemployment;
use App\Observers\Common\BaseObserver;

class QuoteUnemploymentObserver extends BaseObserver
{
    /**
     * Handle the QuoteUnemployment "created" event.
     */
    public function created(QuoteUnemployment $quoteUnemployment): void
    {
        //
    }

    /**
     * Handle the QuoteUnemployment "updated" event.
     */
    public function updated(QuoteUnemployment $quoteUnemployment): void
    {
        //
    }

    /**
     * Handle the QuoteUnemployment "deleted" event.
     */
    public function deleted(QuoteUnemployment $quoteUnemployment): void
    {
        //
    }

    /**
     * Handle the QuoteUnemployment "restored" event.
     */
    public function restored(QuoteUnemployment $quoteUnemployment): void
    {
        //
    }

    /**
     * Handle the QuoteUnemployment "force deleted" event.
     */
    public function forceDeleted(QuoteUnemployment $quoteUnemployment): void
    {
        //
    }
}
