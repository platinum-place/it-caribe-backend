<?php

namespace App\Repositories\Vehicle;

use App\Contracts\Repositories\Vehicle\VehicleTypeRepositoryContract;
use App\Models\Vehicle\VehicleType;
use App\Repositories\BaseRepository;

class VehicleTypeRepository extends BaseRepository implements VehicleTypeRepositoryContract
{
    public function __construct(VehicleType $model)
    {
        parent::__construct($model);
    }
}
