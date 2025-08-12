<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleRoutes\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleRoutes\VehicleRouteResource;

class ViewVehicleRoute extends ViewRecord
{
    protected static string $resource = VehicleRouteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
