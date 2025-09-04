<?php

namespace Modules\Presentation\Catalogs\Vehicles\Filament\Resources\Vehicles\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Presentation\Catalogs\Vehicles\Filament\Resources\Vehicles\VehicleResource;

class ViewVehicle extends ViewRecord
{
    protected static string $resource = VehicleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
