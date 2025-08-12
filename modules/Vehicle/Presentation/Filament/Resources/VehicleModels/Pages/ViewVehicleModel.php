<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleModels\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleModels\VehicleModelResource;

class ViewVehicleModel extends ViewRecord
{
    protected static string $resource = VehicleModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
