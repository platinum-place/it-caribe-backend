<?php

namespace App\Services\Vehicle;

use App\Contracts\Repositories\Vehicle\VehicleMakeRepositoryContract;
use App\Contracts\Services\Vehicle\VehicleMakeServiceContract;
use App\Imports\Vehicle\VehicleMakesImport;
use App\Services\BaseService;
use Maatwebsite\Excel\Facades\Excel;

class VehicleMakeService extends BaseService implements VehicleMakeServiceContract
{
    public function __construct(VehicleMakeRepositoryContract $repository)
    {
        parent::__construct($repository);
    }

    public function import($file)
    {
        Excel::import(new VehicleMakesImport, $file);
    }
}
