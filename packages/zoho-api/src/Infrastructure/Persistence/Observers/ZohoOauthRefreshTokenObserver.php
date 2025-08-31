<?php

namespace Root\ZohoApi\Infrastructure\Persistence\Observers;

use App\Observers\BaseObserver;
use Root\ZohoApi\Infrastructure\Persistence\Models\ZohoOauthRefreshToken;

class ZohoOauthRefreshTokenObserver extends BaseObserver
{
    /**
     * Handle the ZohoOauthRefreshToken "created" event.
     */
    public function created(ZohoOauthRefreshToken $zohoOauthRefreshToken): void
    {
        //
    }

    /**
     * Handle the ZohoOauthRefreshToken "updated" event.
     */
    public function updated(ZohoOauthRefreshToken $zohoOauthRefreshToken): void
    {
        //
    }

    /**
     * Handle the ZohoOauthRefreshToken "deleted" event.
     */
    public function deleted(ZohoOauthRefreshToken $zohoOauthRefreshToken): void
    {
        //
    }

    /**
     * Handle the ZohoOauthRefreshToken "restored" event.
     */
    public function restored(ZohoOauthRefreshToken $zohoOauthRefreshToken): void
    {
        //
    }

    /**
     * Handle the ZohoOauthRefreshToken "force deleted" event.
     */
    public function forceDeleted(ZohoOauthRefreshToken $zohoOauthRefreshToken): void
    {
        //
    }
}
