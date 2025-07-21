<?php

namespace App\Filament\Resources\VehicleActivityResource\Pages;

use App\Filament\Resources\VehicleActivityResource;
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
