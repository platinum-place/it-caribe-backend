<?php

namespace App\Observers;

use App\Observers\BaseObserver;
use App\Models\QuoteStatus;

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
