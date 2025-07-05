<?php

namespace App\Contracts\Services;

interface VehicleMakeServiceContract extends BaseServiceContract
{
    public function import($file);
}
