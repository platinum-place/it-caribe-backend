<?php

namespace App\Filament\Resources\Vehicles\VehicleRouteResource\Pages;

use App\Filament\Resources\Vehicles\VehicleRouteResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewVehicleRoute extends ViewRecord
{
    protected static string $resource = VehicleRouteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
