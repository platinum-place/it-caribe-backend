<?php

namespace App\Contracts;

use App\Entities\ZohoOauthClientEntity;

interface ZohoOauthClientRepositoryInterface
{
    public function findLast(): ZohoOauthClientEntity;
}
