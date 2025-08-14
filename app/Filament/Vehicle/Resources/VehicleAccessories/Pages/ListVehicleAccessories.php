<?php

namespace App\Filament\Vehicle\Resources\VehicleAccessories\Pages;

use App\Filament\Vehicle\Resources\VehicleAccessories\VehicleAccessoryResource;
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
