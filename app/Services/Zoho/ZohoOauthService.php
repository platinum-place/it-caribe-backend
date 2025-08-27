<?php

namespace App\Services\Zoho;

use App\Client\ZohoApiClient;
use App\Models\Zoho\ZohoOauthAccessToken;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;

class ZohoOauthService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected ZohoApiClient $zohoApiClient)
    {
        //
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getAccessToken(): ZohoOauthAccessToken
    {
        $token = ZohoOauthAccessToken::query()
            ->latest('id')
            ->where('expires_at', '>=', now())
            ->first();

        if (! $token) {
            $response = $this->zohoApiClient->getTemporaryToken(config('zoho.oauth.refresh_token'));

            $token = ZohoOauthAccessToken::create($response);
        }

        return $token;
    }
}
