<?php

namespace App\Filament\Resources\VehicleUseResource\Pages;

use App\Filament\Resources\VehicleUseResource;
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
