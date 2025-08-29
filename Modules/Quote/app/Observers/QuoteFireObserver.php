<?php

namespace Modules\Quote\Observers;

use App\Observers\Common\BaseObserver;
use Modules\Quote\Models\QuoteFire;

class QuoteFireObserver extends BaseObserver
{
    /**
     * Handle the QuoteFire "created" event.
     */
    public function created(QuoteFire $quoteFire): void
    {
        //
    }

    /**
     * Handle the QuoteFire "updated" event.
     */
    public function updated(QuoteFire $quoteFire): void
    {
        //
    }

    /**
     * Handle the QuoteFire "deleted" event.
     */
    public function deleted(QuoteFire $quoteFire): void
    {
        //
    }

    /**
     * Handle the QuoteFire "restored" event.
     */
    public function restored(QuoteFire $quoteFire): void
    {
        //
    }

    /**
     * Handle the QuoteFire "force deleted" event.
     */
    public function forceDeleted(QuoteFire $quoteFire): void
    {
        //
    }
}
