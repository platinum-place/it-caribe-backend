<?php

namespace App\Services;

use App\Contracts\Repositories\VehicleMakeRepositoryContract;
use App\Contracts\Services\VehicleMakeServiceContract;
use App\Imports\VehicleMakesImport;
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
