<?php

namespace App\Filament\Resources\Vehicles\VehicleMakeResource\Pages;

use App\Filament\Resources\Vehicles\VehicleMakeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewVehicleMake extends ViewRecord
{
    protected static string $resource = VehicleMakeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
