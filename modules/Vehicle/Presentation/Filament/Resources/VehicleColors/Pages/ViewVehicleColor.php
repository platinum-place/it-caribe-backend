<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleColors\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleColors\VehicleColorResource;

class ViewVehicleColor extends ViewRecord
{
    protected static string $resource = VehicleColorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
