<?php

namespace App\Services;

use App\Contracts\Repositories\VehicleTypeRepositoryContract;
use App\Contracts\Services\VehicleTypeServiceContract;

class VehicleTypeService extends BaseService implements VehicleTypeServiceContract
{
    public function __construct(VehicleTypeRepositoryContract $repository)
    {
        parent::__construct($repository);
    }
}
