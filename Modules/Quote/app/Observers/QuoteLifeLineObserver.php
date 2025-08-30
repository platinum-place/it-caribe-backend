<?php

namespace Modules\Quote\Observers;

use App\Observers\BaseObserver;
use Modules\Quote\Models\QuoteLifeLine;

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
