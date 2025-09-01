<?php

namespace App\Adapters;

use App\Clients\ZohoApiClient;
use App\Contracts\ZohoCRMInterface;
use App\ValueObjects\AccessToken;
use App\ValueObjects\AuthorizationCode;
use App\ValueObjects\OauthClient;
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
    public function fetchRefreshToken(string $grantToken, OauthClient $oauthClient): AuthorizationCode
    {
        $response = $this->client->fetchRefreshToken($grantToken, $oauthClient->clientId, $oauthClient->clientSecret, $oauthClient->redirectUri);

        return new AuthorizationCode(
            $response['refresh_token'],
            new AccessToken(
                $response['access_token'],
                $response['api_domain'],
                $response['token_type'],
                $response['expires_in'],
            ),
        );
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchAccessToken(string $refreshToken, OauthClient $oauthClient): AccessToken
    {
        $response = $this->client->fetchAccessToken($refreshToken, $oauthClient->clientId, $oauthClient->clientSecret);

        return new AccessToken(
            $response['access_token'],
            $response['api_domain'],
            $response['token_type'],
            $response['expires_in'],
            $response['scope'],
        );
    }
}
