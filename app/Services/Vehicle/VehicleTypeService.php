<?php

namespace App\Services\Vehicle;

use App\Contracts\Repositories\Vehicle\VehicleTypeRepositoryContract;
use App\Contracts\Services\Vehicle\VehicleTypeServiceContract;
use App\Services\BaseService;

class VehicleTypeService extends BaseService implements VehicleTypeServiceContract
{
    public function __construct(VehicleTypeRepositoryContract $repository)
    {
        parent::__construct($repository);
    }
}
