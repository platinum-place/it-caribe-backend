<?php

namespace App\Filament\Resources\VehicleRouteResource\Pages;

use App\Filament\Resources\VehicleRouteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVehicleRoute extends EditRecord
{
    protected static string $resource = VehicleRouteResource::class;

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
