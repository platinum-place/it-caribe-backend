<?php

namespace App\Observers\Quote\Fire;

use App\Models\Quote\Fire\QuoteFireRiskType;
use App\Observers\Common\BaseObserver;

class QuoteFireRiskTypeObserver extends BaseObserver
{
    /**
     * Handle the QuoteFireRiskType "created" event.
     */
    public function created(QuoteFireRiskType $quoteFireRiskType): void
    {
        //
    }

    /**
     * Handle the QuoteFireRiskType "updated" event.
     */
    public function updated(QuoteFireRiskType $quoteFireRiskType): void
    {
        //
    }

    /**
     * Handle the QuoteFireRiskType "deleted" event.
     */
    public function deleted(QuoteFireRiskType $quoteFireRiskType): void
    {
        //
    }

    /**
     * Handle the QuoteFireRiskType "restored" event.
     */
    public function restored(QuoteFireRiskType $quoteFireRiskType): void
    {
        //
    }

    /**
     * Handle the QuoteFireRiskType "force deleted" event.
     */
    public function forceDeleted(QuoteFireRiskType $quoteFireRiskType): void
    {
        //
    }
}
