<?php

namespace App\Filament\Resources\Vehicle\VehicleColors\Pages;

use App\Filament\Resources\Vehicle\VehicleColors\VehicleColorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVehicleColors extends ListRecords
{
    protected static string $resource = VehicleColorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
