<?php

namespace Modules\Quote\Observers;

use App\Models\QuoteUnemploymentLine;
use App\Observers\Common\BaseObserver;

class QuoteUnemploymentLineObserver extends BaseObserver
{
    /**
     * Handle the QuoteUnemploymentLine "created" event.
     */
    public function created(QuoteUnemploymentLine $quoteUnemploymentLine): void
    {
        //
    }

    /**
     * Handle the QuoteUnemploymentLine "updated" event.
     */
    public function updated(QuoteUnemploymentLine $quoteUnemploymentLine): void
    {
        //
    }

    /**
     * Handle the QuoteUnemploymentLine "deleted" event.
     */
    public function deleted(QuoteUnemploymentLine $quoteUnemploymentLine): void
    {
        //
    }

    /**
     * Handle the QuoteUnemploymentLine "restored" event.
     */
    public function restored(QuoteUnemploymentLine $quoteUnemploymentLine): void
    {
        //
    }

    /**
     * Handle the QuoteUnemploymentLine "force deleted" event.
     */
    public function forceDeleted(QuoteUnemploymentLine $quoteUnemploymentLine): void
    {
        //
    }
}
