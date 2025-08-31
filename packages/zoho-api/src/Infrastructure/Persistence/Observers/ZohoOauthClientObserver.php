<?php

namespace Root\ZohoApi\Infrastructure\Persistence\Observers;

use App\Observers\BaseObserver;
use Root\ZohoApi\Infrastructure\Persistence\Models\ZohoOauthClient;

class ZohoOauthClientObserver extends BaseObserver
{
    /**
     * Handle the ZohoOauthClient "created" event.
     */
    public function created(ZohoOauthClient $zohoOauthClient): void
    {
        //
    }

    /**
     * Handle the ZohoOauthClient "updated" event.
     */
    public function updated(ZohoOauthClient $zohoOauthClient): void
    {
        //
    }

    /**
     * Handle the ZohoOauthClient "deleted" event.
     */
    public function deleted(ZohoOauthClient $zohoOauthClient): void
    {
        //
    }

    /**
     * Handle the ZohoOauthClient "restored" event.
     */
    public function restored(ZohoOauthClient $zohoOauthClient): void
    {
        //
    }

    /**
     * Handle the ZohoOauthClient "force deleted" event.
     */
    public function forceDeleted(ZohoOauthClient $zohoOauthClient): void
    {
        //
    }
}
