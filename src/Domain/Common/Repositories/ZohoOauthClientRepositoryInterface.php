<?php

namespace Modules\Domain\Common\Repositories;

use Modules\Domain\Common\Entities\ZohoOauthClientEntity;

interface ZohoOauthClientRepositoryInterface
{
    public function findLast(): ZohoOauthClientEntity;
}
