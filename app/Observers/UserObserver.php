<?php

namespace App\Observers;

use App\Models\User;
use App\Observers\Common\BaseObserver;
use Illuminate\Database\Eloquent\Model;

class UserObserver extends BaseObserver
{
    public function creating(Model $model): void
    {
        //
    }

    public function updating(Model $model): void
    {
        //
    }

    public function deleting(Model $model): void
    {
        //
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
