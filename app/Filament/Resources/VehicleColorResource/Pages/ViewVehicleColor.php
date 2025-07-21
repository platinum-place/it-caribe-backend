<?php

namespace App\Filament\Resources\VehicleColorResource\Pages;

use App\Filament\Resources\VehicleColorResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewVehicleColor extends ViewRecord
{
    protected static string $resource = VehicleColorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
