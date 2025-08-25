<?php

namespace App\Observers\Quote\Life;

use App\Models\Quote\Life\QuoteLifeLine;
use App\Observers\BaseObserver;

class QuoteLifeLineObserver extends BaseObserver
{
    /**
     * Handle the QuoteLifeLine "created" event.
     */
    public function created(QuoteLifeLine $quoteLifeLine): void
    {
        //
    }

    /**
     * Handle the QuoteLifeLine "updated" event.
     */
    public function updated(QuoteLifeLine $quoteLifeLine): void
    {
        //
    }

    /**
     * Handle the QuoteLifeLine "deleted" event.
     */
    public function deleted(QuoteLifeLine $quoteLifeLine): void
    {
        //
    }

    /**
     * Handle the QuoteLifeLine "restored" event.
     */
    public function restored(QuoteLifeLine $quoteLifeLine): void
    {
        //
    }

    /**
     * Handle the QuoteLifeLine "force deleted" event.
     */
    public function forceDeleted(QuoteLifeLine $quoteLifeLine): void
    {
        //
    }
}
