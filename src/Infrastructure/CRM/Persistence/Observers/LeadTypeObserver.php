<?php

namespace Modules\Infrastructure\CRM\Persistence\Observers;

use App\Observers\BaseObserver;
use Modules\Infrastructure\CRM\Persistence\Models\LeadType;

class LeadTypeObserver extends BaseObserver
{
    /**
     * Handle the LeadType "created" event.
     */
    public function created(LeadType $leadType): void
    {
        //
    }

    /**
     * Handle the LeadType "updated" event.
     */
    public function updated(LeadType $leadType): void
    {
        //
    }

    /**
     * Handle the LeadType "deleted" event.
     */
    public function deleted(LeadType $leadType): void
    {
        //
    }

    /**
     * Handle the LeadType "restored" event.
     */
    public function restored(LeadType $leadType): void
    {
        //
    }

    /**
     * Handle the LeadType "force deleted" event.
     */
    public function forceDeleted(LeadType $leadType): void
    {
        //
    }
}
