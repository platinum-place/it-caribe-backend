<?php

namespace App\Filament\Resources\VehicleRoutes\Pages;

use App\Filament\Resources\VehicleRoutes\VehicleRouteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

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
