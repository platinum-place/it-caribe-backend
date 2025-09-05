<?php

namespace Modules\Domain\API\Zoho\Contracts;

use Modules\Domain\API\Zoho\Entities\ZohoOauthAccessTokenEntity;

interface ZohoOauthAccessTokenRepositoryInterface
{
    public function store(string $accessToken, string $apiDomain, string $tokenType, int $expiresIn, ?string $scope = null): ZohoOauthAccessTokenEntity;

    public function fetchMostRecent(): ZohoOauthAccessTokenEntity;
}
