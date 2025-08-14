<?php

namespace App\Filament\Vehicle\Resources\VehicleUtilities\Pages;

use App\Filament\Vehicle\Resources\VehicleUtilities\VehicleUtilityResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewVehicleUtility extends ViewRecord
{
    protected static string $resource = VehicleUtilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
