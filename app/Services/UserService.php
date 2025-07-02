<?php

namespace App\Services;

use App\Contracts\Repositories\UserRepositoryContract;
use App\Contracts\Services\UserServiceContract;

class UserService extends BaseService implements UserServiceContract
{
    public function __construct(UserRepositoryContract $repository)
    {
        parent::__construct($repository);
    }
}
