<?php

namespace App\Filament\Resources\Vehicles\VehicleModelResource\Pages;

use App\Filament\Resources\Vehicles\VehicleModelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVehicleModel extends EditRecord
{
    protected static string $resource = VehicleModelResource::class;

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
