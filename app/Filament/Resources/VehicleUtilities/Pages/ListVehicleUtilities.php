<?php

namespace App\Filament\Resources\VehicleUtilities\Pages;

use App\Filament\Resources\VehicleUtilities\VehicleUtilityResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVehicleUtilities extends ListRecords
{
    protected static string $resource = VehicleUtilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
