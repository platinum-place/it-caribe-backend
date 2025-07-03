<?php

namespace App\Repositories\Vehicle;

use App\Contracts\Repositories\Vehicle\VehicleMakeRepositoryContract;
use App\Models\Vehicle\VehicleMake;
use App\Repositories\BaseRepository;

class VehicleMakeRepository extends BaseRepository implements VehicleMakeRepositoryContract
{
    public function __construct(VehicleMake $model)
    {
        parent::__construct($model);
    }
}
