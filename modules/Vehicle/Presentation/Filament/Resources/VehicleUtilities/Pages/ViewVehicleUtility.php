<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleUtilities\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleUtilities\VehicleUtilityResource;

class ViewVehicleUtility extends ViewRecord
{
    protected static string $resource = VehicleUtilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
