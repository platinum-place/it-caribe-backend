<?php

namespace App\Repositories;

use App\Contracts\Repositories\ZohoOauthAccessTokenRepositoryContract;
use App\Models\ZohoOauthAccessToken;

class ZohoOauthAccessTokenRepository extends BaseRepository implements ZohoOauthAccessTokenRepositoryContract
{
    public function __construct(ZohoOauthAccessToken $model)
    {
        parent::__construct($model);
    }
}
