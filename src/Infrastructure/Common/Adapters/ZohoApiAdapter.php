<?php

namespace Modules\Infrastructure\Common\Adapters;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Modules\Domain\Common\Contracts\ZohoCRMInterface;
use Modules\Domain\Common\ValueObjects\AccessToken;
use Modules\Domain\Common\ValueObjects\AuthorizationCode;
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
    public function fetchRefreshToken(string $grantToken, string $clientId, string $clientSecret, string $redirectUri): AuthorizationCode
    {
        $response = $this->client->fetchRefreshToken($grantToken, $clientId, $clientSecret, $redirectUri);

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
    public function fetchAccessToken(string $refreshToken, string $clientId, string $clientSecret): AccessToken
    {
        $response = $this->client->fetchAccessToken($refreshToken, $clientId, $clientSecret);

        return new AccessToken(
            $response['access_token'],
            $response['api_domain'],
            $response['token_type'],
            $response['expires_in'],
            $response['scope'],
        );
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchRecordsByCriteria(string $module, string $accessToken, string $criteria, int $page = 1, int $perPage = 200): array
    {
        $response = $this->client->fetchRecordsByCriteria($module, $accessToken, $criteria, $page, $perPage);

        return $response['data'];
    }
}
