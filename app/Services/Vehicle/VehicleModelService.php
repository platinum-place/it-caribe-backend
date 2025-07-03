<?php

namespace App\Services\Vehicle;

use App\Contracts\Repositories\Vehicle\VehicleModelRepositoryContract;
use App\Contracts\Services\Vehicle\VehicleModelServiceContract;
use App\Imports\Vehicle\VehicleMakesImport;
use App\Imports\Vehicle\VehicleModelsImport;
use App\Services\BaseService;
use Maatwebsite\Excel\Facades\Excel;

class VehicleModelService extends BaseService implements VehicleModelServiceContract
{
    public function __construct(VehicleModelRepositoryContract $repository)
    {
        parent::__construct($repository);
    }

    public function import( $file)
    {
        Excel::import(new VehicleModelsImport, $file);
    }
}
