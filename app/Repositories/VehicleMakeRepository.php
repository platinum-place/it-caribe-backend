<?php

namespace App\Repositories;

use App\Contracts\Repositories\VehicleMakeRepositoryContract;
use App\Models\VehicleMake;

class VehicleMakeRepository extends BaseRepository implements VehicleMakeRepositoryContract
{
    public function __construct(VehicleMake $model)
    {
        parent::__construct($model);
    }
}
