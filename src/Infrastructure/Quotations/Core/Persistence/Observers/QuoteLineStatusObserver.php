<?php

namespace Modules\Infrastructure\Quotations\Core\Persistence\Observers;

use App\Observers\BaseObserver;
use Modules\Infrastructure\Quotations\Core\Persistence\Models\QuoteLineStatus;

class QuoteLineStatusObserver extends BaseObserver
{
    /**
     * Handle the QuoteLineStatus "created" event.
     */
    public function created(QuoteLineStatus $quoteLineStatus): void
    {
        //
    }

    /**
     * Handle the QuoteLineStatus "updated" event.
     */
    public function updated(QuoteLineStatus $quoteLineStatus): void
    {
        //
    }

    /**
     * Handle the QuoteLineStatus "deleted" event.
     */
    public function deleted(QuoteLineStatus $quoteLineStatus): void
    {
        //
    }

    /**
     * Handle the QuoteLineStatus "restored" event.
     */
    public function restored(QuoteLineStatus $quoteLineStatus): void
    {
        //
    }

    /**
     * Handle the QuoteLineStatus "force deleted" event.
     */
    public function forceDeleted(QuoteLineStatus $quoteLineStatus): void
    {
        //
    }
}
