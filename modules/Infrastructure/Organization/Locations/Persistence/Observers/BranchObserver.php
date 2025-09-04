<?php

namespace Modules\Infrastructure\Organization\Locations\Persistence\Observers;

use App\Observers\BaseObserver;
use Modules\Infrastructure\Organization\Locations\Persistence\Models\Branch;

class BranchObserver extends BaseObserver
{
    /**
     * Handle the Branch "created" event.
     */
    public function created(Branch $branch): void
    {
        $branch->users()->attach(config('app.admin_id'));
    }

    /**
     * Handle the Branch "updated" event.
     */
    public function updated(Branch $branch): void
    {
        //
    }

    /**
     * Handle the Branch "deleted" event.
     */
    public function deleted(Branch $branch): void
    {
        //
    }

    /**
     * Handle the Branch "restored" event.
     */
    public function restored(Branch $branch): void
    {
        //
    }

    /**
     * Handle the Branch "force deleted" event.
     */
    public function forceDeleted(Branch $branch): void
    {
        //
    }
}
