<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleTypes\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleTypes\VehicleTypeResource;

class ViewVehicleType extends ViewRecord
{
    protected static string $resource = VehicleTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
