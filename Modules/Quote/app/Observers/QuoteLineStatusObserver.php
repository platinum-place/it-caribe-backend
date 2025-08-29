<?php

namespace Modules\Quote\Observers;

use App\Models\QuoteLineStatus;
use App\Observers\Common\BaseObserver;

class QuoteLineStatusObserver extends BaseObserver
{
    /**
     * Handle the QuoteLineStatus "created" event.
     */
    public function created(QuoteLineStatus $quoteLineStatus): void
    {
        //
    }

    /**
     * Handle the QuoteLineStatus "updated" event.
     */
    public function updated(QuoteLineStatus $quoteLineStatus): void
    {
        //
    }

    /**
     * Handle the QuoteLineStatus "deleted" event.
     */
    public function deleted(QuoteLineStatus $quoteLineStatus): void
    {
        //
    }

    /**
     * Handle the QuoteLineStatus "restored" event.
     */
    public function restored(QuoteLineStatus $quoteLineStatus): void
    {
        //
    }

    /**
     * Handle the QuoteLineStatus "force deleted" event.
     */
    public function forceDeleted(QuoteLineStatus $quoteLineStatus): void
    {
        //
    }
}
