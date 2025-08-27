<?php

namespace App\Observers\Quote;

use App\Models\Quote\QuoteStatus;
use App\Observers\Common\BaseObserver;

class QuoteStatusObserver extends BaseObserver
{
    /**
     * Handle the QuoteStatus "created" event.
     */
    public function created(QuoteStatus $quoteStatus): void
    {
        //
    }

    /**
     * Handle the QuoteStatus "updated" event.
     */
    public function updated(QuoteStatus $quoteStatus): void
    {
        //
    }

    /**
     * Handle the QuoteStatus "deleted" event.
     */
    public function deleted(QuoteStatus $quoteStatus): void
    {
        //
    }

    /**
     * Handle the QuoteStatus "restored" event.
     */
    public function restored(QuoteStatus $quoteStatus): void
    {
        //
    }

    /**
     * Handle the QuoteStatus "force deleted" event.
     */
    public function forceDeleted(QuoteStatus $quoteStatus): void
    {
        //
    }
}
