<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleLoanTypes\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleLoanTypes\VehicleLoanTypeResource;

class ViewVehicleLoanType extends ViewRecord
{
    protected static string $resource = VehicleLoanTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
