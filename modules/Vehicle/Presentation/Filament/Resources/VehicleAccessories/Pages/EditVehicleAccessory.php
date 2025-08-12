<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleAccessories\Pages;

use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleAccessories\VehicleAccessoryResource;

class EditVehicleAccessory extends EditRecord
{
    protected static string $resource = VehicleAccessoryResource::class;

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
