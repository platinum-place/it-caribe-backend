<?php

namespace App\Filament\Resources\Vehicle\VehicleTypeResource\Pages;

use App\Filament\Imports\Vehicle\VehicleTypeImporter;
use App\Filament\Resources\Vehicle\VehicleTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageVehicleTypes extends ManageRecords
{
    protected static string $resource = VehicleTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
