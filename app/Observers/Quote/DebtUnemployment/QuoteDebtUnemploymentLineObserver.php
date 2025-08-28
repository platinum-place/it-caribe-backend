<?php

namespace App\Observers\Quote\DebtUnemployment;

use App\Models\Quote\DebtUnemployment\QuoteDebtUnemploymentLine;
use App\Observers\Common\BaseObserver;

class QuoteDebtUnemploymentLineObserver extends BaseObserver
{
    /**
     * Handle the QuoteDebtUnemploymentLine "created" event.
     */
    public function created(QuoteDebtUnemploymentLine $quoteDebtUnemploymentLine): void
    {
        //
    }

    /**
     * Handle the QuoteDebtUnemploymentLine "updated" event.
     */
    public function updated(QuoteDebtUnemploymentLine $quoteDebtUnemploymentLine): void
    {
        //
    }

    /**
     * Handle the QuoteDebtUnemploymentLine "deleted" event.
     */
    public function deleted(QuoteDebtUnemploymentLine $quoteDebtUnemploymentLine): void
    {
        //
    }

    /**
     * Handle the QuoteDebtUnemploymentLine "restored" event.
     */
    public function restored(QuoteDebtUnemploymentLine $quoteDebtUnemploymentLine): void
    {
        //
    }

    /**
     * Handle the QuoteDebtUnemploymentLine "force deleted" event.
     */
    public function forceDeleted(QuoteDebtUnemploymentLine $quoteDebtUnemploymentLine): void
    {
        //
    }
}
