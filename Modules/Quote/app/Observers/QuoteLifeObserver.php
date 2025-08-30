<?php

namespace Modules\Quote\Observers;

use App\Observers\BaseObserver;
use Modules\Quote\Models\QuoteLife;

class QuoteLifeObserver extends BaseObserver
{
    /**
     * Handle the QuoteLife "created" event.
     */
    public function created(QuoteLife $quoteLife): void
    {
        //
    }

    /**
     * Handle the QuoteLife "updated" event.
     */
    public function updated(QuoteLife $quoteLife): void
    {
        //
    }

    /**
     * Handle the QuoteLife "deleted" event.
     */
    public function deleted(QuoteLife $quoteLife): void
    {
        //
    }

    /**
     * Handle the QuoteLife "restored" event.
     */
    public function restored(QuoteLife $quoteLife): void
    {
        //
    }

    /**
     * Handle the QuoteLife "force deleted" event.
     */
    public function forceDeleted(QuoteLife $quoteLife): void
    {
        //
    }
}
