<?php

namespace App\Observers\Quote;

use App\Models\Quote\QuoteLine;
use App\Observers\BaseObserver;

class QuoteLineObserver extends BaseObserver
{
    /**
     * Handle the QuoteLine "created" event.
     */
    public function created(QuoteLine $quoteLine): void
    {
        //
    }

    /**
     * Handle the QuoteLine "updated" event.
     */
    public function updated(QuoteLine $quoteLine): void
    {
        //
    }

    /**
     * Handle the QuoteLine "deleted" event.
     */
    public function deleted(QuoteLine $quoteLine): void
    {
        //
    }

    /**
     * Handle the QuoteLine "restored" event.
     */
    public function restored(QuoteLine $quoteLine): void
    {
        //
    }

    /**
     * Handle the QuoteLine "force deleted" event.
     */
    public function forceDeleted(QuoteLine $quoteLine): void
    {
        //
    }
}
