<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleRoutes\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleRoutes\VehicleRouteResource;

class ListVehicleRoutes extends ListRecords
{
    protected static string $resource = VehicleRouteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
