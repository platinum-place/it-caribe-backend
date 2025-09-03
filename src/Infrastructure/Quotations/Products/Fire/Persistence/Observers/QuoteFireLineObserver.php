<?php

namespace Modules\Infrastructure\Quotations\Products\Fire\Persistence\Observers;

use App\Observers\BaseObserver;
use Modules\Infrastructure\Quotations\Products\Fire\Persistence\Models\QuoteFireLine;

class QuoteFireLineObserver extends BaseObserver
{
    /**
     * Handle the QuoteFireLine "created" event.
     */
    public function created(QuoteFireLine $quoteFireLine): void
    {
        //
    }

    /**
     * Handle the QuoteFireLine "updated" event.
     */
    public function updated(QuoteFireLine $quoteFireLine): void
    {
        //
    }

    /**
     * Handle the QuoteFireLine "deleted" event.
     */
    public function deleted(QuoteFireLine $quoteFireLine): void
    {
        //
    }

    /**
     * Handle the QuoteFireLine "restored" event.
     */
    public function restored(QuoteFireLine $quoteFireLine): void
    {
        //
    }

    /**
     * Handle the QuoteFireLine "force deleted" event.
     */
    public function forceDeleted(QuoteFireLine $quoteFireLine): void
    {
        //
    }
}
