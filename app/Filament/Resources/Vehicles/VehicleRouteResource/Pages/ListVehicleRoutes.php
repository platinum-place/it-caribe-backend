<?php

namespace App\Filament\Resources\Vehicles\VehicleRouteResource\Pages;

use App\Filament\Resources\Vehicles\VehicleRouteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVehicleRoutes extends ListRecords
{
    protected static string $resource = VehicleRouteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
