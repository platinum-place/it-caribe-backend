<?php

namespace App\Services\Zoho;

use App\Contracts\ZohoCRMInterface;
use App\Models\Zoho\ZohoOauthAccessToken;
use App\Models\Zoho\ZohoOauthRefreshToken;

class FetchTokenService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected ZohoCRMInterface $zohoCRM, protected RefreshTokenService $refreshTokenService)
    {
        //
    }

    public function handle(): ZohoOauthAccessToken
    {
        $accessToken = ZohoOauthAccessToken::query()
            ->latest()
            ->where('expires_at', '>=', now())
            ->first();

        if (! $accessToken) {
            $refreshToken = ZohoOauthRefreshToken::query()
                ->latest()
                ->firstOrFail();

            $accessToken = $this->refreshTokenService->handle($refreshToken->refresh_token);
        }

        return $accessToken;
    }
}
