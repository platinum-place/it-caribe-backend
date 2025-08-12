<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleModels\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleModels\VehicleModelResource;

class CreateVehicleModel extends CreateRecord
{
    protected static string $resource = VehicleModelResource::class;
}
