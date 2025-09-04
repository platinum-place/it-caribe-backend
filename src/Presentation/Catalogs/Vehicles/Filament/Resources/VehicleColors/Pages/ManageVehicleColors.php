<?php

namespace Modules\Presentation\Catalogs\Vehicles\Filament\Resources\VehicleColors\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Modules\Presentation\Catalogs\Vehicles\Filament\Resources\VehicleColors\VehicleColorResource;

class ManageVehicleColors extends ManageRecords
{
    protected static string $resource = VehicleColorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
