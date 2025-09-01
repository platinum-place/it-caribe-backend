<?php

namespace App\Filament\Resources\VehicleUtilities\Pages;

use App\Filament\Resources\VehicleUtilities\VehicleUtilityResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageVehicleUtilities extends ManageRecords
{
    protected static string $resource = VehicleUtilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
