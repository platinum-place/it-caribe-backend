<?php

namespace App\Filament\Resources\Vehicle\VehicleMakes\Pages;

use App\Filament\Resources\Vehicle\VehicleMakes\VehicleMakeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewVehicleMake extends ViewRecord
{
    protected static string $resource = VehicleMakeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
