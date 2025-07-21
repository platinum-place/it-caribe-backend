<?php

namespace App\Filament\Resources\VehicleUseResource\Pages;

use App\Filament\Resources\VehicleUseResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewVehicleUse extends ViewRecord
{
    protected static string $resource = VehicleUseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
