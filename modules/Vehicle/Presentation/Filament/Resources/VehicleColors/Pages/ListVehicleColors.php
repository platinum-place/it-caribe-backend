<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleColors\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleColors\VehicleColorResource;

class ListVehicleColors extends ListRecords
{
    protected static string $resource = VehicleColorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
