<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleUtilityResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleUtilityResource;

class ViewVehicleUtility extends ViewRecord
{
    protected static string $resource = VehicleUtilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
