<?php

namespace App\Filament\Resources\VehicleMakeResource\Pages;

use App\Filament\Resources\VehicleMakeResource;
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
