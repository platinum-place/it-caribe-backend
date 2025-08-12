<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleActivities\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleActivities\VehicleActivityResource;

class ListVehicleActivities extends ListRecords
{
    protected static string $resource = VehicleActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
