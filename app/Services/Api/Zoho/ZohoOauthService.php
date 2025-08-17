<?php

namespace App\Services\Api\Zoho;

use App\Client\ZohoApiClient;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;

class ZohoOauthService
{
    public function __construct(protected ZohoApiClient $zohoApiClient) {}

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getAccessToken(): \App\DTOs\Api\Zoho\ZohoTokenDTO
    {
        return $this->zohoApiClient->getTemporaryToken(config('zoho.oauth.refresh_token'));
    }
}
