<?php

namespace App\Filament\Resources\Vehicle\VehicleModels\Pages;

use App\Filament\Resources\Vehicle\VehicleModels\VehicleModelResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

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
