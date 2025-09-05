<?php

namespace Modules\Infrastructure\API\Zoho\Persistence\Observers;

use App\Observers\BaseObserver;
use Modules\Infrastructure\API\Zoho\Persistence\Models\ZohoOauthAccessToken;

class ZohoOauthAccessTokenObserver extends BaseObserver
{
    /**
     * Handle the ZohoOauthAccessToken "created" event.
     */
    public function created(ZohoOauthAccessToken $zohoOauthAccessToken): void
    {
        //
    }

    /**
     * Handle the ZohoOauthAccessToken "updated" event.
     */
    public function updated(ZohoOauthAccessToken $zohoOauthAccessToken): void
    {
        //
    }

    /**
     * Handle the ZohoOauthAccessToken "deleted" event.
     */
    public function deleted(ZohoOauthAccessToken $zohoOauthAccessToken): void
    {
        //
    }

    /**
     * Handle the ZohoOauthAccessToken "restored" event.
     */
    public function restored(ZohoOauthAccessToken $zohoOauthAccessToken): void
    {
        //
    }

    /**
     * Handle the ZohoOauthAccessToken "force deleted" event.
     */
    public function forceDeleted(ZohoOauthAccessToken $zohoOauthAccessToken): void
    {
        //
    }
}
