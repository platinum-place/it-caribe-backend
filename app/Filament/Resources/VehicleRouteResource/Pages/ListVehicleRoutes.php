<?php

namespace App\Filament\Resources\VehicleRouteResource\Pages;

use App\Filament\Resources\VehicleRouteResource;
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
