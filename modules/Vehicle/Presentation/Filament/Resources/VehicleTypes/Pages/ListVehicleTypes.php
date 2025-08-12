<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleTypes\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleTypes\VehicleTypeResource;

class ListVehicleTypes extends ListRecords
{
    protected static string $resource = VehicleTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
