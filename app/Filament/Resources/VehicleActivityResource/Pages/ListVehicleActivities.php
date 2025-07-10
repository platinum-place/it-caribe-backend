<?php

namespace App\Filament\Resources\VehicleActivityResource\Pages;

use App\Filament\Resources\VehicleActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVehicleActivities extends ListRecords
{
    protected static string $resource = VehicleActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
