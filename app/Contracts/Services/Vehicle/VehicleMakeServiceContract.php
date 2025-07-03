<?php

namespace App\Contracts\Services\Vehicle;

use App\Contracts\Services\BaseServiceContract;

interface VehicleMakeServiceContract extends BaseServiceContract
{
    public function import($file);
}
