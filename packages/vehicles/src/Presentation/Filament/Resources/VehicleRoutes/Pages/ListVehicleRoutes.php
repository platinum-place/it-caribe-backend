<?php

namespace App\Filament\Resources\Vehicle\VehicleRoutes\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use old\Filament\Resources\Vehicle\VehicleRoutes\VehicleRouteResource;

class ListVehicleRoutes extends ListRecords
{
    protected static string $resource = VehicleRouteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
