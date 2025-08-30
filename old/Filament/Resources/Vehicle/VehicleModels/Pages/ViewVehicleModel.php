<?php

namespace App\Filament\Resources\Vehicle\VehicleModels\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use old\Filament\Resources\Vehicle\VehicleModels\VehicleModelResource;

class ViewVehicleModel extends ViewRecord
{
    protected static string $resource = VehicleModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
