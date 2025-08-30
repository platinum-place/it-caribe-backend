<?php

namespace Modules\Quote\Observers;

use App\Observers\BaseObserver;
use Modules\Quote\Models\QuoteFireCreditType;

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
