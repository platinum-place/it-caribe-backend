<?php

namespace App\Services;

use App\Contracts\Repositories\ZohoOauthAccessTokenRepositoryContract;
use App\Contracts\Services\ZohoOauthAccessTokenServiceContract;

class ZohoOauthAccessTokenService extends BaseService implements ZohoOauthAccessTokenServiceContract
{
    public function __construct(ZohoOauthAccessTokenRepositoryContract $repository)
    {
        parent::__construct($repository);
    }
}
