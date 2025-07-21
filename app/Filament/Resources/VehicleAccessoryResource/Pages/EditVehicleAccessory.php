<?php

namespace App\Filament\Resources\VehicleAccessoryResource\Pages;

use App\Filament\Resources\VehicleAccessoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVehicleAccessory extends EditRecord
{
    protected static string $resource = VehicleAccessoryResource::class;

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
