<?php

namespace App\Contracts;

use App\Entities\ZohoOauthRefreshTokenEntity;

interface ZohoOauthRefreshTokenRepositoryInterface
{
    public function store(string $refreshToken): ZohoOauthRefreshTokenEntity;

    public function findLast(): ZohoOauthRefreshTokenEntity;
}
