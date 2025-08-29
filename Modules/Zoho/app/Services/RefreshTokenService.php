<?php

namespace Modules\Zoho\Services;

use App\Models\Zoho\ZohoOauthAccessToken;
use Modules\Zoho\Contracts\ZohoCRMInterface;

class RefreshTokenService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected ZohoCRMInterface $zohoCRM)
    {
        //
    }

    public function handle(string $refreshToken): ZohoOauthAccessToken
    {
        $response = $this->zohoCRM->fetchAccessToken($refreshToken);

        return ZohoOauthAccessToken::create([
            'access_token' => $response->accessToken,
            'api_domain' => $response->apiDomain,
            'token_type' => $response->tokenType,
            'expires_in' => $response->expiresIn,
        ]);
    }
}
