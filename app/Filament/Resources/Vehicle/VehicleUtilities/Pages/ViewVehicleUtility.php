<?php

namespace App\Filament\Resources\Vehicle\VehicleUtilities\Pages;

use App\Filament\Resources\Vehicle\VehicleUtilities\VehicleUtilityResource;
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
