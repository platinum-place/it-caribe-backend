<?php

namespace App\Observers\Zoho;

use App\Models\Zoho\ZohoOauthAccessToken;

class ZohoOauthAccessTokenObserver
{
    public function creating(ZohoOauthAccessToken $zohoOauthAccessToken): void
    {
        $zohoOauthAccessToken->created_by = auth()->id() ?? 1;
        $zohoOauthAccessToken->expires_at = now()->addSeconds($zohoOauthAccessToken->expires_in);
    }

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
