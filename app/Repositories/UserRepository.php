<?php

namespace App\Repositories;

use App\Contracts\Repositories\UserRepositoryContract;
use App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryContract
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
