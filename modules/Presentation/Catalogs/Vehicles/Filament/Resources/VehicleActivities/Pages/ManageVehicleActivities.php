<?php

namespace Modules\Presentation\Catalogs\Vehicles\Filament\Resources\VehicleActivities\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Modules\Presentation\Catalogs\Vehicles\Filament\Resources\VehicleActivities\VehicleActivityResource;

class ManageVehicleActivities extends ManageRecords
{
    protected static string $resource = VehicleActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
