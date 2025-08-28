<?php

namespace App\Services\Zoho;

use App\Contracts\ZohoCRMInterface;
use App\Models\Zoho\ZohoOauthAccessToken;
use App\Models\Zoho\ZohoOauthRefreshToken;

class StoreTokenService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected ZohoCRMInterface $zohoCRM)
    {
        //
    }

    public function handle(string $grantToken): ZohoOauthAccessToken
    {
        $response = $this->zohoCRM->fetchRefreshToken($grantToken);

        ZohoOauthRefreshToken::create([
            'refresh_token' => $response->refreshToken,
            'api_domain' => $response->apiDomain,
            'token_type' => $response->tokenType,
        ]);

        return ZohoOauthAccessToken::create([
            'access_token' => $response->accessToken,
            'api_domain' => $response->apiDomain,
            'token_type' => $response->tokenType,
            'expires_in' => $response->expiresIn,
        ]);
    }
}
