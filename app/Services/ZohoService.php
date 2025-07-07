<?php

namespace App\Services;

use App\Contracts\Services\ZohoAPIServiceContract;
use App\Contracts\Services\ZohoServiceContract;
use App\Models\ZohoOauthAccessToken;
use App\Models\ZohoOauthRefreshToken;

class ZohoService implements ZohoServiceContract
{
    public function __construct(protected ZohoAPIServiceContract $zohoAPIServiceContract) {}

    public function getAccessToken(): ?ZohoOauthAccessToken
    {
        return ZohoOauthAccessToken::latest('id')
            ->where('expires_at', '>=', now())
            ->first();
    }

    public function generateAccessToken(): ?ZohoOauthAccessToken
    {
        $clientId = config('zoho.oauth.client_id');
        $clientSecret = config('zoho.oauth.client_secret');
        $refreshToken = ZohoOauthRefreshToken::latest('id')->value('refresh_token');

        $response = $this->zohoAPIServiceContract->getTemporaryToken($clientId, $clientSecret, $refreshToken);

        return ZohoOauthAccessToken::create([
            'access_token' => $response['access_token'],
            'expires_at' => now()->addSeconds($response['expires_in']),
        ]);
    }
}
