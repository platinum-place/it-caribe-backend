<?php

namespace App\Filament\Vehicle\Resources\VehicleActivities\Pages;

use App\Filament\Vehicle\Resources\VehicleActivities\VehicleActivityResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewVehicleActivity extends ViewRecord
{
    protected static string $resource = VehicleActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
