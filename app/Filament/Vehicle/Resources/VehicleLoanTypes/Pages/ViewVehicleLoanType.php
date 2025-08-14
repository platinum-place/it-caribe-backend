<?php

namespace App\Filament\Vehicle\Resources\VehicleLoanTypes\Pages;

use App\Filament\Vehicle\Resources\VehicleLoanTypes\VehicleLoanTypeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

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
