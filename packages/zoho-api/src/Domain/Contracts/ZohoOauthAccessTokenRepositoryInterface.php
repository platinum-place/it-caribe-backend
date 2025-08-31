<?php

namespace Root\ZohoApi\Domain\Contracts;

use Root\ZohoApi\Domain\Entities\ZohoOauthAccessTokenEntity;
use Root\ZohoApi\Domain\ValueObjects\AccessToken;

interface ZohoOauthAccessTokenRepositoryInterface
{
    public function store(AccessToken $accessToken): ZohoOauthAccessTokenEntity;
}
