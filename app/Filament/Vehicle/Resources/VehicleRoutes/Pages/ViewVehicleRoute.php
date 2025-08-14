<?php

namespace App\Filament\Vehicle\Resources\VehicleRoutes\Pages;

use App\Filament\Vehicle\Resources\VehicleRoutes\VehicleRouteResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewVehicleRoute extends ViewRecord
{
    protected static string $resource = VehicleRouteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
