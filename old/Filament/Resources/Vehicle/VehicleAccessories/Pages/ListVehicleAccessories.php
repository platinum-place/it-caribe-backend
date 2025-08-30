<?php

namespace App\Filament\Resources\Vehicle\VehicleAccessories\Pages;

use old\Filament\Resources\Vehicle\VehicleAccessories\VehicleAccessoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVehicleAccessories extends ListRecords
{
    protected static string $resource = VehicleAccessoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
