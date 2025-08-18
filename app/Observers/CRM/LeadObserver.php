<?php

namespace App\Observers\CRM;

use App\Models\CRM\Lead;
use Carbon\Carbon;

class LeadObserver
{
    public function creating(Lead $lead): void
    {
        if (! $lead->age && $lead->birth_date) {
            $lead->age = Carbon::parse($lead->birth_date)->age;
        }

        if (! $lead->full_name && ($lead->first_name && $lead->last_name)) {
            $lead->full_name = $lead->first_name.' '.$lead->last_name;
        }
    }

    /**
     * Handle the Lead "created" event.
     */
    public function created(Lead $lead): void
    {
        //
    }

    /**
     * Handle the Lead "updated" event.
     */
    public function updated(Lead $lead): void
    {
        //
    }

    /**
     * Handle the Lead "deleted" event.
     */
    public function deleted(Lead $lead): void
    {
        //
    }

    /**
     * Handle the Lead "restored" event.
     */
    public function restored(Lead $lead): void
    {
        //
    }

    /**
     * Handle the Lead "force deleted" event.
     */
    public function forceDeleted(Lead $lead): void
    {
        //
    }
}
