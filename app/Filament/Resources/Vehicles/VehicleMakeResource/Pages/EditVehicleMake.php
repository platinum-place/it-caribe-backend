<?php

namespace App\Filament\Resources\Vehicles\VehicleMakeResource\Pages;

use App\Filament\Resources\Vehicles\VehicleMakeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVehicleMake extends EditRecord
{
    protected static string $resource = VehicleMakeResource::class;

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
