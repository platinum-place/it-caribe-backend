<?php

namespace App\Services\Api\Zoho;

use App\Models\ZohoOauthAccessToken;
use App\Models\ZohoOauthRefreshToken;
use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;

class ZohoOAuthTokenService
{
    public function __construct(
        protected ZohoAPIService $api
    ) {
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
            $token = $this->generateRefreshAccessToken();
        }

        return $token;
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     * @throws Exception
     */
    protected function generateRefreshAccessToken()
    {
        $refreshToken = ZohoOauthRefreshToken::latest('id')->value('refresh_token');

        if (!$refreshToken) {
            throw new Exception(__('Not Found'));
        }

        $response = $this->api->getTemporaryToken($refreshToken);

        $this->createAccessToken($response);

        return $response['access_token'];
    }

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
        $response = $this->api->getPersistentToken($grantToken);

        $this->createAccessToken($response);

        ZohoOauthRefreshToken::create([
            'refresh_token' => $response['refresh_token'],
        ]);

        return $response['access_token'];
    }
}
