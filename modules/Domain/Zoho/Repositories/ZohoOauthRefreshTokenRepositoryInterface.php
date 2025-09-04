<?php

namespace Modules\Domain\Zoho\Repositories;

use Modules\Domain\Zoho\Entities\ZohoOauthRefreshTokenEntity;

interface ZohoOauthRefreshTokenRepositoryInterface
{
    public function store(string $refreshToken): ZohoOauthRefreshTokenEntity;

    public function findLast(): ZohoOauthRefreshTokenEntity;
}
