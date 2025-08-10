<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleActivityResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleActivityResource;

class ListVehicleActivities extends ListRecords
{
    protected static string $resource = VehicleActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
