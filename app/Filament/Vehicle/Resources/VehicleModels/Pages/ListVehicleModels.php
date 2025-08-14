<?php

namespace App\Filament\Vehicle\Resources\VehicleModels\Pages;

use App\Filament\Vehicle\Resources\VehicleModels\VehicleModelResource;
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
