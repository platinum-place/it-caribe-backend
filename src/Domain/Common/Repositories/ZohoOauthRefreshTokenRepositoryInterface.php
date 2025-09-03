<?php

namespace Modules\Domain\Common\Repositories;

use Modules\Domain\Common\Entities\ZohoOauthRefreshTokenEntity;

interface ZohoOauthRefreshTokenRepositoryInterface
{
    public function store(string $refreshToken): ZohoOauthRefreshTokenEntity;

    public function findLast(): ZohoOauthRefreshTokenEntity;
}
