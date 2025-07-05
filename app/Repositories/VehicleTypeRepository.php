<?php

namespace App\Repositories;

use App\Contracts\Repositories\VehicleTypeRepositoryContract;
use App\Models\VehicleType;

class VehicleTypeRepository extends BaseRepository implements VehicleTypeRepositoryContract
{
    public function __construct(VehicleType $model)
    {
        parent::__construct($model);
    }
}
