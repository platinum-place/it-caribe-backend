<?php

namespace App\Filament\Resources\Vehicles\VehicleUseResource\Pages;

use App\Filament\Resources\Vehicles\VehicleUseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVehicleUse extends EditRecord
{
    protected static string $resource = VehicleUseResource::class;

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
