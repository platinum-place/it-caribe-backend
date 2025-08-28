<?php

namespace App\Filament\Resources\Vehicle\VehicleRoutes\Pages;

use App\Filament\Resources\Vehicle\VehicleRoutes\VehicleRouteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

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
