<?php

namespace Root\ZohoApi\Domain\Contracts;

use Root\ZohoApi\Domain\Entities\ZohoOauthClientEntity;

interface ZohoOauthClientRepositoryInterface
{
    public function findLast(): ZohoOauthClientEntity;
}
