<?php

namespace Modules\Infrastructure\Common\Adapters;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Modules\Domain\Common\Contracts\ZohoCRMInterface;
use Modules\Domain\Common\ValueObjects\AccessToken;
use Modules\Domain\Common\ValueObjects\AuthorizationCode;
use Modules\Domain\Common\ValueObjects\OauthClient;
use Modules\Infrastructure\Common\Clients\ZohoApiClient;

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
