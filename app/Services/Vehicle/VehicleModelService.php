<?php

namespace App\Services\Vehicle;

use App\Contracts\Repositories\Vehicle\VehicleModelRepositoryContract;
use App\Contracts\Services\Vehicle\VehicleModelServiceContract;
use App\Services\BaseService;

class VehicleModelService extends BaseService implements VehicleModelServiceContract
{
    public function __construct(VehicleModelRepositoryContract $repository)
    {
        parent::__construct($repository);
    }
}
