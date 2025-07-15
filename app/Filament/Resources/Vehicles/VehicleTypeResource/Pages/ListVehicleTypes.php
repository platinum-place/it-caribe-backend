<?php

namespace App\Filament\Resources\Vehicles\VehicleTypeResource\Pages;

use App\Filament\Resources\Vehicles\VehicleTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVehicleTypes extends ListRecords
{
    protected static string $resource = VehicleTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
