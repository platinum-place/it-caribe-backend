<?php

namespace App\Filament\Resources\Vehicles\VehicleMakeResource\Pages;

use App\Filament\Resources\Vehicles\VehicleMakeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVehicleMakes extends ListRecords
{
    protected static string $resource = VehicleMakeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
