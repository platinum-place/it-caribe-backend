<?php

namespace App\Filament\Resources\Vehicles\VehicleResource\Pages;

use App\Filament\Resources\Vehicles\VehicleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVehicles extends ListRecords
{
    protected static string $resource = VehicleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
