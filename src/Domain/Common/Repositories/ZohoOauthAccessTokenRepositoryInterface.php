<?php

namespace Modules\Domain\Common\Repositories;

use Modules\Domain\Common\Entities\ZohoOauthAccessTokenEntity;
use Modules\Domain\Common\ValueObjects\AccessToken;

interface ZohoOauthAccessTokenRepositoryInterface
{
    public function store(AccessToken $accessToken): ZohoOauthAccessTokenEntity;
}
