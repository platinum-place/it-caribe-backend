<?php

namespace App\Filament\Vehicle\Resources\VehicleAccessories\Pages;

use App\Filament\Vehicle\Resources\VehicleAccessories\VehicleAccessoryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewVehicleAccessory extends ViewRecord
{
    protected static string $resource = VehicleAccessoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
