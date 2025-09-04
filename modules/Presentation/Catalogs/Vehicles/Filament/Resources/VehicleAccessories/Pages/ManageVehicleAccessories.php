<?php

namespace Modules\Presentation\Catalogs\Vehicles\Filament\Resources\VehicleAccessories\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Modules\Presentation\Catalogs\Vehicles\Filament\Resources\VehicleAccessories\VehicleAccessoryResource;

class ManageVehicleAccessories extends ManageRecords
{
    protected static string $resource = VehicleAccessoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
