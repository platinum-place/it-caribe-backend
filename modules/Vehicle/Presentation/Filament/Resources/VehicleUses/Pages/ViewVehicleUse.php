<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleUses\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleUses\VehicleUseResource;

class ViewVehicleUse extends ViewRecord
{
    protected static string $resource = VehicleUseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
