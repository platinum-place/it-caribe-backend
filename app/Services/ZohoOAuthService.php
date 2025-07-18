<?php

namespace App\Services;

use App\Models\ZohoOauthAccessToken;
use App\Models\ZohoOauthRefreshToken;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use ZohoOAuth;

class ZohoOAuthService
{
    protected function createAccessToken(array $data): void
    {
        $expiresAt = now()->addSeconds($data['expires_in']);

        ZohoOauthAccessToken::create([
            'access_token' => $data['access_token'],
            'expires_at' => $expiresAt,
        ]);
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function generateAccessToken(string $grantToken): string
    {
        $response = ZohoOAuth::getPersistentToken($grantToken);

        $this->createAccessToken($response);

        ZohoOauthRefreshToken::create([
            'refresh_token' => $response['refresh_token'],
        ]);

        return $response['access_token'];
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function refreshAccessToken(): string
    {
        $refreshToken = ZohoOauthRefreshToken::latest('id')->value('refresh_token');

        if (! $refreshToken) {
            throw new \Exception(__('Not Found'));
        }

        $response = ZohoOAuth::getTemporaryToken($refreshToken);

        $this->createAccessToken($response);

        return $response['access_token'];
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getAccessToken(): string
    {
        $token = ZohoOauthAccessToken::latest('id')
            ->where('expires_at', '>=', now())
            ->value('access_token');

        if (! $token) {
            $token = $this->refreshAccessToken();
        }

        return $token;
    }
}
