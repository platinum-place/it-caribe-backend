<?php

namespace App\Filament\Resources\VehicleRoutes\Pages;

use App\Filament\Resources\VehicleRoutes\VehicleRouteResource;
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
