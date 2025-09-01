<?php

namespace App\Filament\Resources\VehicleLoanTypes\Pages;

use App\Filament\Resources\VehicleLoanTypes\VehicleLoanTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageVehicleLoanTypes extends ManageRecords
{
    protected static string $resource = VehicleLoanTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
