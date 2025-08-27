<?php

namespace App\Observers\Quote\Fire;

use App\Models\Quote\Fire\QuoteFireCreditType;
use App\Observers\Common\BaseObserver;

class QuoteFireCreditTypeObserver extends BaseObserver
{
    /**
     * Handle the QuoteFireCreditType "created" event.
     */
    public function created(QuoteFireCreditType $quoteFireCreditType): void
    {
        //
    }

    /**
     * Handle the QuoteFireCreditType "updated" event.
     */
    public function updated(QuoteFireCreditType $quoteFireCreditType): void
    {
        //
    }

    /**
     * Handle the QuoteFireCreditType "deleted" event.
     */
    public function deleted(QuoteFireCreditType $quoteFireCreditType): void
    {
        //
    }

    /**
     * Handle the QuoteFireCreditType "restored" event.
     */
    public function restored(QuoteFireCreditType $quoteFireCreditType): void
    {
        //
    }

    /**
     * Handle the QuoteFireCreditType "force deleted" event.
     */
    public function forceDeleted(QuoteFireCreditType $quoteFireCreditType): void
    {
        //
    }
}
