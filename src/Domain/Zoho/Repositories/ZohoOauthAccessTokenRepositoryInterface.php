<?php

namespace Modules\Domain\Zoho\Repositories;

use Modules\Domain\Zoho\Entities\ZohoOauthAccessTokenEntity;
use Modules\Domain\Zoho\ValueObjects\AccessToken;

interface ZohoOauthAccessTokenRepositoryInterface
{
    public function store(AccessToken $accessToken): ZohoOauthAccessTokenEntity;

    public function findLast(): ZohoOauthAccessTokenEntity;
}
