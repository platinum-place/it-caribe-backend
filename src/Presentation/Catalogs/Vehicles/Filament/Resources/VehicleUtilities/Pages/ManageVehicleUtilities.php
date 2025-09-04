<?php

namespace Modules\Presentation\Catalogs\Vehicles\Filament\Resources\VehicleUtilities\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Modules\Presentation\Catalogs\Vehicles\Filament\Resources\VehicleUtilities\VehicleUtilityResource;

class ManageVehicleUtilities extends ManageRecords
{
    protected static string $resource = VehicleUtilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
