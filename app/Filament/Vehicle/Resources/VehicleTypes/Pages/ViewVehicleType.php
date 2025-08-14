<?php

namespace App\Filament\Vehicle\Resources\VehicleTypes\Pages;

use App\Filament\Vehicle\Resources\VehicleTypes\VehicleTypeResource;
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
