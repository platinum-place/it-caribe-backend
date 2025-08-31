<?php

namespace Root\ZohoApi\Infrastructure\Adapters;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Root\ZohoApi\Domain\Contracts\ZohoCRMInterface;
use Root\ZohoApi\Domain\ValueObjects\AccessToken;
use Root\ZohoApi\Domain\ValueObjects\RefreshToken;
use Root\ZohoApi\Infrastructure\Services\ZohoApiClient;

class ZohoApiAdapter implements ZohoCRMInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected ZohoApiClient $client)
    {
        //
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchRefreshToken(string $grantToken, string $clientId, string $clientSecret, string $redirectUri): RefreshToken
    {
        $response = $this->client->fetchRefreshToken($grantToken, $clientId, $clientSecret, $redirectUri);

        return new RefreshToken(
            $response['access_token'],
            $response['refresh_token'],
            $response['api_domain'],
            $response['token_type'],
            $response['expires_in'],
        );
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchAccessToken(string $refreshToken): AccessToken
    {
        $response = $this->client->fetchAccessToken($refreshToken);

        return new AccessToken(
            $response['access_token'],
            $response['scope'],
            $response['api_domain'],
            $response['token_type'],
            $response['expires_in'],
        );
    }
}
