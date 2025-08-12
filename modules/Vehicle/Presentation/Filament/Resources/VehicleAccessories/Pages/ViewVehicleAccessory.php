<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleAccessories\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleAccessories\VehicleAccessoryResource;

class ViewVehicleAccessory extends ViewRecord
{
    protected static string $resource = VehicleAccessoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
