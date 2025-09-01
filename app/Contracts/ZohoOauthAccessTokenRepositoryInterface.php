<?php

namespace App\Contracts;

use App\Entities\ZohoOauthAccessTokenEntity;
use App\ValueObjects\AccessToken;

interface ZohoOauthAccessTokenRepositoryInterface
{
    public function store(AccessToken $accessToken): ZohoOauthAccessTokenEntity;
}
