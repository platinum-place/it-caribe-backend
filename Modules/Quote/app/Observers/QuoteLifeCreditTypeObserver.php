<?php

namespace Modules\Quote\Observers;

use App\Models\QuoteLifeCreditType;
use App\Observers\Common\BaseObserver;

class QuoteLifeCreditTypeObserver extends BaseObserver
{
    /**
     * Handle the QuoteLifeCreditType "created" event.
     */
    public function created(QuoteLifeCreditType $quoteLifeCreditType): void
    {
        //
    }

    /**
     * Handle the QuoteLifeCreditType "updated" event.
     */
    public function updated(QuoteLifeCreditType $quoteLifeCreditType): void
    {
        //
    }

    /**
     * Handle the QuoteLifeCreditType "deleted" event.
     */
    public function deleted(QuoteLifeCreditType $quoteLifeCreditType): void
    {
        //
    }

    /**
     * Handle the QuoteLifeCreditType "restored" event.
     */
    public function restored(QuoteLifeCreditType $quoteLifeCreditType): void
    {
        //
    }

    /**
     * Handle the QuoteLifeCreditType "force deleted" event.
     */
    public function forceDeleted(QuoteLifeCreditType $quoteLifeCreditType): void
    {
        //
    }
}
