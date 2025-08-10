<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleLoanTypeResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleLoanTypeResource;

class ViewVehicleLoanType extends ViewRecord
{
    protected static string $resource = VehicleLoanTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
