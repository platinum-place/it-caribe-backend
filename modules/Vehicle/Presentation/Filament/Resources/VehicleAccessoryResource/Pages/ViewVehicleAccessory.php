<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleAccessoryResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleAccessoryResource;

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
