<?php

namespace Modules\Presentation\Catalogs\Vehicles\Filament\Resources\VehicleRoutes\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Modules\Presentation\Catalogs\Vehicles\Filament\Resources\VehicleRoutes\VehicleRouteResource;

class ManageVehicleRoutes extends ManageRecords
{
    protected static string $resource = VehicleRouteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
