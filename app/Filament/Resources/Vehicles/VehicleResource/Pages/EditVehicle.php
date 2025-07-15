<?php

namespace App\Filament\Resources\Vehicles\VehicleResource\Pages;

use App\Filament\Resources\Vehicles\VehicleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVehicle extends EditRecord
{
    protected static string $resource = VehicleResource::class;

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
