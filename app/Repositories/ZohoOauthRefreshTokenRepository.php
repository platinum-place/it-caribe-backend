<?php

namespace App\Repositories;

use App\Contracts\Repositories\ZohoOauthRefreshTokenRepositoryContract;
use App\Models\ZohoOauthRefreshToken;

class ZohoOauthRefreshTokenRepository extends BaseRepository implements ZohoOauthRefreshTokenRepositoryContract
{
    public function __construct(ZohoOauthRefreshToken $model)
    {
        parent::__construct($model);
    }
}
