<?php

namespace App\Filament\Resources\Vehicle\VehicleUses\Pages;

use old\Filament\Resources\Vehicle\VehicleUses\VehicleUseResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewVehicleUse extends ViewRecord
{
    protected static string $resource = VehicleUseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
