<?php

namespace App\Observers\Zoho;

use App\Models\Zoho\ZohoOauthAccessToken;
use App\Observers\BaseObserver;

class ZohoOauthAccessTokenObserver extends BaseObserver
{
    public function creating(ZohoOauthAccessToken|\Illuminate\Database\Eloquent\Model $model): void
    {
        parent::creating($model);

        $model->expires_at = now()->addSeconds($model->expires_in);
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
