<?php

namespace App\Filament\Resources\Vehicle\VehicleActivities\Pages;

use old\Filament\Resources\Vehicle\VehicleActivities\VehicleActivityResource;
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
