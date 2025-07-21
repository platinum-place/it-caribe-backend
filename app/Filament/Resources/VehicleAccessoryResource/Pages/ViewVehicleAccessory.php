<?php

namespace App\Filament\Resources\VehicleAccessoryResource\Pages;

use App\Filament\Resources\VehicleAccessoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewVehicleAccessory extends ViewRecord
{
    protected static string $resource = VehicleAccessoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
