<?php

namespace App\Filament\Vehicle\Resources\VehicleModels\Pages;

use App\Filament\Vehicle\Resources\VehicleModels\VehicleModelResource;
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
