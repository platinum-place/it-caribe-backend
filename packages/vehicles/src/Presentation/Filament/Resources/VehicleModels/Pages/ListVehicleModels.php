<?php

namespace App\Filament\Resources\Vehicle\VehicleModels\Pages;

use old\Filament\Resources\Vehicle\VehicleModels\VehicleModelResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVehicleModels extends ListRecords
{
    protected static string $resource = VehicleModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
