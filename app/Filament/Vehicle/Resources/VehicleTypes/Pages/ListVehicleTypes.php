<?php

namespace App\Filament\Vehicle\Resources\VehicleTypes\Pages;

use App\Filament\Vehicle\Resources\VehicleTypes\VehicleTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

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
