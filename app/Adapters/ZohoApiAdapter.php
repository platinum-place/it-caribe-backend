<?php

namespace App\Adapters;

use App\Client\ZohoApiClient;
use App\Contracts\ZohoCRMInterface;
use App\DTOs\Zoho\AccessTokenDTO;
use App\DTOs\Zoho\RefreshTokenDTO;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;

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
    public function fetchRefreshToken(string $grantToken): RefreshTokenDTO
    {
        $response = $this->client->fetchRefreshToken($grantToken);

        return new RefreshTokenDTO(
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
    public function fetchAccessToken(string $refreshToken): AccessTokenDTO
    {
        $response = $this->client->fetchAccessToken($refreshToken);

        return new AccessTokenDTO(
            $response['access_token'],
            $response['scope'],
            $response['api_domain'],
            $response['token_type'],
            $response['expires_in'],
        );
    }
}
