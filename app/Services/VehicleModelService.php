<?php

namespace App\Services;

use App\Contracts\Repositories\VehicleModelRepositoryContract;
use App\Contracts\Services\VehicleModelServiceContract;
use App\Imports\VehicleModelsImport;
use Maatwebsite\Excel\Facades\Excel;

class VehicleModelService extends BaseService implements VehicleModelServiceContract
{
    public function __construct(VehicleModelRepositoryContract $repository)
    {
        parent::__construct($repository);
    }

    public function import($file)
    {
        Excel::import(new VehicleModelsImport, $file);
    }
}
