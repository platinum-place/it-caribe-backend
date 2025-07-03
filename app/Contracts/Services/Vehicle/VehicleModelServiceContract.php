<?php

namespace App\Contracts\Services\Vehicle;

use App\Contracts\Services\BaseServiceContract;

interface VehicleModelServiceContract extends BaseServiceContract
{
    public function import($file);
}
