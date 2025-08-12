<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleMakes\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleMakes\VehicleMakeResource;

class ViewVehicleMake extends ViewRecord
{
    protected static string $resource = VehicleMakeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
