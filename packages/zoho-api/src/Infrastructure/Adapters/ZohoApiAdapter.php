<?php

namespace Root\ZohoApi\Infrastructure\Adapters;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Root\ZohoApi\Domain\Contracts\ZohoCRMInterface;
use Root\ZohoApi\Domain\ValueObjects\AccessToken;
use Root\ZohoApi\Domain\ValueObjects\AuthorizationCode;
use Root\ZohoApi\Domain\ValueObjects\OauthClient;
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
