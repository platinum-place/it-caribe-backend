<?php

namespace Modules\Quote\Observers;

use App\Models\QuoteDebtUnemployment;
use App\Observers\Common\BaseObserver;

class QuoteDebtUnemploymentObserver extends BaseObserver
{
    /**
     * Handle the QuoteDebtUnemployment "created" event.
     */
    public function created(QuoteDebtUnemployment $quoteDebtUnemployment): void
    {
        //
    }

    /**
     * Handle the QuoteDebtUnemployment "updated" event.
     */
    public function updated(QuoteDebtUnemployment $quoteDebtUnemployment): void
    {
        //
    }

    /**
     * Handle the QuoteDebtUnemployment "deleted" event.
     */
    public function deleted(QuoteDebtUnemployment $quoteDebtUnemployment): void
    {
        //
    }

    /**
     * Handle the QuoteDebtUnemployment "restored" event.
     */
    public function restored(QuoteDebtUnemployment $quoteDebtUnemployment): void
    {
        //
    }

    /**
     * Handle the QuoteDebtUnemployment "force deleted" event.
     */
    public function forceDeleted(QuoteDebtUnemployment $quoteDebtUnemployment): void
    {
        //
    }
}
