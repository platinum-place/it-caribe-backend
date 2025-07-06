<?php

namespace App\Services;

use App\Contracts\Repositories\ZohoOauthRefreshTokenRepositoryContract;
use App\Contracts\Services\ZohoOauthRefreshTokenServiceContract;

class ZohoOauthRefreshTokenService extends BaseService implements ZohoOauthRefreshTokenServiceContract
{
    public function __construct(ZohoOauthRefreshTokenRepositoryContract $repository)
    {
        parent::__construct($repository);
    }
}
