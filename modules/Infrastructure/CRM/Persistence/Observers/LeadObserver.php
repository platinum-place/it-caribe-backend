<?php

namespace Modules\Infrastructure\CRM\Persistence\Observers;

use App\Observers\BaseObserver;
use Carbon\Carbon;
use Modules\Infrastructure\CRM\Persistence\Models\Lead;

class LeadObserver extends BaseObserver
{
    public function creating(Lead|\Illuminate\Database\Eloquent\Model $model): void
    {
        parent::creating($model);

        if (! $model->age && $model->birth_date) {
            $model->age = Carbon::parse($model->birth_date)->age;
        }

        if (! $model->full_name && ($model->first_name && $model->last_name)) {
            $model->full_name = $model->first_name.' '.$model->last_name;
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
