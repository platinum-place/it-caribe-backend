<?php

namespace Modules\Quote\Observers;

use App\Models\QuoteUnemploymentEmploymentType;
use App\Observers\Common\BaseObserver;

class QuoteUnemploymentEmploymentTypeObserver extends BaseObserver
{
    /**
     * Handle the QuoteUnemploymentEmploymentType "created" event.
     */
    public function created(QuoteUnemploymentEmploymentType $quoteUnemploymentEmploymentType): void
    {
        //
    }

    /**
     * Handle the QuoteUnemploymentEmploymentType "updated" event.
     */
    public function updated(QuoteUnemploymentEmploymentType $quoteUnemploymentEmploymentType): void
    {
        //
    }

    /**
     * Handle the QuoteUnemploymentEmploymentType "deleted" event.
     */
    public function deleted(QuoteUnemploymentEmploymentType $quoteUnemploymentEmploymentType): void
    {
        //
    }

    /**
     * Handle the QuoteUnemploymentEmploymentType "restored" event.
     */
    public function restored(QuoteUnemploymentEmploymentType $quoteUnemploymentEmploymentType): void
    {
        //
    }

    /**
     * Handle the QuoteUnemploymentEmploymentType "force deleted" event.
     */
    public function forceDeleted(QuoteUnemploymentEmploymentType $quoteUnemploymentEmploymentType): void
    {
        //
    }
}
