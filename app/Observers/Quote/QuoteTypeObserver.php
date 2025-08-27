<?php

namespace App\Observers\Quote;

use App\Models\Quote\QuoteType;
use App\Observers\Common\BaseObserver;

class QuoteTypeObserver extends BaseObserver
{
    /**
     * Handle the QuoteType "created" event.
     */
    public function created(QuoteType $quoteType): void
    {
        //
    }

    /**
     * Handle the QuoteType "updated" event.
     */
    public function updated(QuoteType $quoteType): void
    {
        //
    }

    /**
     * Handle the QuoteType "deleted" event.
     */
    public function deleted(QuoteType $quoteType): void
    {
        //
    }

    /**
     * Handle the QuoteType "restored" event.
     */
    public function restored(QuoteType $quoteType): void
    {
        //
    }

    /**
     * Handle the QuoteType "force deleted" event.
     */
    public function forceDeleted(QuoteType $quoteType): void
    {
        //
    }
}
