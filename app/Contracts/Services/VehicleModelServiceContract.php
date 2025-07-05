<?php

namespace App\Contracts\Services;

interface VehicleModelServiceContract extends BaseServiceContract
{
    public function import($file);
}
