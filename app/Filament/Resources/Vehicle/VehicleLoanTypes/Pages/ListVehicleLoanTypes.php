<?php

namespace App\Filament\Resources\Vehicle\VehicleLoanTypes\Pages;

use App\Filament\Resources\Vehicle\VehicleLoanTypes\VehicleLoanTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVehicleLoanTypes extends ListRecords
{
    protected static string $resource = VehicleLoanTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
