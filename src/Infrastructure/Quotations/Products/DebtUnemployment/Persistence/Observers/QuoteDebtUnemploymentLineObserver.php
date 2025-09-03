<?php

namespace Modules\Infrastructure\Quotations\Products\DebtUnemployment\Persistence\Observers;

use App\Observers\BaseObserver;
use Modules\Infrastructure\Quotations\Products\DebtUnemployment\Persistence\Models\QuoteDebtUnemploymentLine;

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
