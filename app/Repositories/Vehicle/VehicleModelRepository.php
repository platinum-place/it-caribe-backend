<?php

namespace App\Repositories\Vehicle;

use App\Contracts\Repositories\Vehicle\VehicleModelRepositoryContract;
use App\Models\Vehicle\VehicleModel;
use App\Repositories\BaseRepository;

class VehicleModelRepository extends BaseRepository implements VehicleModelRepositoryContract
{
    public function __construct(VehicleModel $model)
    {
        parent::__construct($model);
    }
}
