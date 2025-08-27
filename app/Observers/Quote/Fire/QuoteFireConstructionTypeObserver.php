<?php

namespace App\Observers\Quote\Fire;

use App\Models\Quote\Fire\QuoteFireConstructionType;
use App\Observers\Common\BaseObserver;

class QuoteFireConstructionTypeObserver extends BaseObserver
{
    /**
     * Handle the QuoteFireConstructionType "created" event.
     */
    public function created(QuoteFireConstructionType $quoteFireConstructionType): void
    {
        //
    }

    /**
     * Handle the QuoteFireConstructionType "updated" event.
     */
    public function updated(QuoteFireConstructionType $quoteFireConstructionType): void
    {
        //
    }

    /**
     * Handle the QuoteFireConstructionType "deleted" event.
     */
    public function deleted(QuoteFireConstructionType $quoteFireConstructionType): void
    {
        //
    }

    /**
     * Handle the QuoteFireConstructionType "restored" event.
     */
    public function restored(QuoteFireConstructionType $quoteFireConstructionType): void
    {
        //
    }

    /**
     * Handle the QuoteFireConstructionType "force deleted" event.
     */
    public function forceDeleted(QuoteFireConstructionType $quoteFireConstructionType): void
    {
        //
    }
}
