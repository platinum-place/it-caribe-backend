<?php

namespace Modules\Domain\Zoho\Repositories;

use Modules\Domain\Zoho\Entities\ZohoOauthClientEntity;

interface ZohoOauthClientRepositoryInterface
{
    public function findLast(): ZohoOauthClientEntity;
}
