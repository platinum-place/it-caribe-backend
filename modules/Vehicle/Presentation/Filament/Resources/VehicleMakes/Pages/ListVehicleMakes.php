<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleMakes\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleMakes\VehicleMakeResource;

class ListVehicleMakes extends ListRecords
{
    protected static string $resource = VehicleMakeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
