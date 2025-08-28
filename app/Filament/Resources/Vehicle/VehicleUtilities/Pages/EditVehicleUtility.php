<?php

namespace App\Filament\Resources\Vehicle\VehicleUtilities\Pages;

use App\Filament\Resources\Vehicle\VehicleUtilities\VehicleUtilityResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditVehicleUtility extends EditRecord
{
    protected static string $resource = VehicleUtilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
