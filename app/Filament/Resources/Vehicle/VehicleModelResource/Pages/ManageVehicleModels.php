<?php

namespace App\Filament\Resources\Vehicle\VehicleModelResource\Pages;

use App\Filament\Imports\Vehicle\VehicleModelImporter;
use App\Filament\Resources\Vehicle\VehicleModelResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageVehicleModels extends ManageRecords
{
    protected static string $resource = VehicleModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
