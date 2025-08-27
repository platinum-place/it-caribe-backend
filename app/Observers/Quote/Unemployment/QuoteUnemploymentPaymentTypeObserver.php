<?php

namespace App\Observers\Quote\Unemployment;

use App\Models\Quote\Unemployment\QuoteUnemploymentPaymentType;
use App\Observers\Common\BaseObserver;

class QuoteUnemploymentPaymentTypeObserver extends BaseObserver
{
    /**
     * Handle the QuoteUnemploymentPaymentType "created" event.
     */
    public function created(QuoteUnemploymentPaymentType $quoteUnemploymentPaymentType): void
    {
        //
    }

    /**
     * Handle the QuoteUnemploymentPaymentType "updated" event.
     */
    public function updated(QuoteUnemploymentPaymentType $quoteUnemploymentPaymentType): void
    {
        //
    }

    /**
     * Handle the QuoteUnemploymentPaymentType "deleted" event.
     */
    public function deleted(QuoteUnemploymentPaymentType $quoteUnemploymentPaymentType): void
    {
        //
    }

    /**
     * Handle the QuoteUnemploymentPaymentType "restored" event.
     */
    public function restored(QuoteUnemploymentPaymentType $quoteUnemploymentPaymentType): void
    {
        //
    }

    /**
     * Handle the QuoteUnemploymentPaymentType "force deleted" event.
     */
    public function forceDeleted(QuoteUnemploymentPaymentType $quoteUnemploymentPaymentType): void
    {
        //
    }
}
