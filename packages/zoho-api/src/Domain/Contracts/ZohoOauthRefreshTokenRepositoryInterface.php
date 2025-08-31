<?php

namespace Root\ZohoApi\Domain\Contracts;

use Root\ZohoApi\Domain\Entities\ZohoOauthClientEntity;
use Root\ZohoApi\Domain\Entities\ZohoOauthRefreshTokenEntity;

interface ZohoOauthRefreshTokenRepositoryInterface
{
    public function store(string $refreshToken): ZohoOauthRefreshTokenEntity;
}
