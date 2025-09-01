<?php

namespace App\Filament\Resources\VehicleActivities\Pages;

use App\Filament\Resources\VehicleActivities\VehicleActivityResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageVehicleActivities extends ManageRecords
{
    protected static string $resource = VehicleActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
