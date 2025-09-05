<?php

namespace Modules\Domain\API\Zoho\Contracts;

use Modules\Domain\API\Zoho\Entities\ZohoOauthRefreshTokenEntity;

interface ZohoOauthRefreshTokenRepositoryInterface
{
    public function store(string $refreshToken): ZohoOauthRefreshTokenEntity;

    public function fetchMostRecent(): ZohoOauthRefreshTokenEntity;
}
