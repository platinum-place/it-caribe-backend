<?php

namespace App\Filament\Resources\VehicleAccessoryResource\Pages;

use App\Filament\Resources\VehicleAccessoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVehicleAccessories extends ListRecords
{
    protected static string $resource = VehicleAccessoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
