<?php

namespace App\Repositories;

use App\Contracts\Repositories\VehicleModelRepositoryContract;
use App\Models\VehicleModel;

class VehicleModelRepository extends BaseRepository implements VehicleModelRepositoryContract
{
    public function __construct(VehicleModel $model)
    {
        parent::__construct($model);
    }
}
