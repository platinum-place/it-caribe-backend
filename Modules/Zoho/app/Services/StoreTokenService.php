<?php

namespace Modules\Zoho\Services;

use Modules\Zoho\Contracts\ZohoCRMInterface;
use Modules\Zoho\Models\ZohoOauthAccessToken;
use Modules\Zoho\Models\ZohoOauthRefreshToken;

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
