<?php

namespace Modules\Infrastructure\Quotations\Products\Fire\Persistence\Observers;

use App\Observers\BaseObserver;
use Modules\Infrastructure\Quotations\Products\Fire\Persistence\Models\QuoteFireRiskType;

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
