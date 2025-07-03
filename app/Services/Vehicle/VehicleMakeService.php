<?php

namespace App\Services\Vehicle;

use App\Contracts\Repositories\Vehicle\VehicleMakeRepositoryContract;
use App\Contracts\Services\Vehicle\VehicleMakeServiceContract;
use App\Services\BaseService;

class VehicleMakeService extends BaseService implements VehicleMakeServiceContract
{
    public function __construct(VehicleMakeRepositoryContract $repository)
    {
        parent::__construct($repository);
    }
}
