<?php

namespace App\Filament\Resources\VehicleAccessories\Pages;

use App\Filament\Resources\VehicleAccessories\VehicleAccessoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageVehicleAccessories extends ManageRecords
{
    protected static string $resource = VehicleAccessoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
