<?php

namespace App\Filament\Resources\Vehicle\VehicleTypes\Pages;

use old\Filament\Resources\Vehicle\VehicleTypes\VehicleTypeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewVehicleType extends ViewRecord
{
    protected static string $resource = VehicleTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
