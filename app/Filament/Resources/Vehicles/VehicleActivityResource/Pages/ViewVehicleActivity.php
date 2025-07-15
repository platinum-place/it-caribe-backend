<?php

namespace App\Filament\Resources\Vehicles\VehicleActivityResource\Pages;

use App\Filament\Resources\Vehicles\VehicleActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewVehicleActivity extends ViewRecord
{
    protected static string $resource = VehicleActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
