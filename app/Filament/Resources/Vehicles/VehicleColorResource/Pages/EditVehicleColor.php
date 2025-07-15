<?php

namespace App\Filament\Resources\Vehicles\VehicleColorResource\Pages;

use App\Filament\Resources\Vehicles\VehicleColorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVehicleColor extends EditRecord
{
    protected static string $resource = VehicleColorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
