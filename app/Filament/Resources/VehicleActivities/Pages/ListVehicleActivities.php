<?php

namespace App\Filament\Resources\VehicleActivities\Pages;

use App\Filament\Resources\VehicleActivities\VehicleActivityResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVehicleActivities extends ListRecords
{
    protected static string $resource = VehicleActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
