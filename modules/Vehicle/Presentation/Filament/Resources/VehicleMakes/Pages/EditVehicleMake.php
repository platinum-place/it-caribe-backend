<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleMakes\Pages;

use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleMakes\VehicleMakeResource;

class EditVehicleMake extends EditRecord
{
    protected static string $resource = VehicleMakeResource::class;

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
