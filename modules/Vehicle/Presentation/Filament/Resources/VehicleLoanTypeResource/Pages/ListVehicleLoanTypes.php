<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleLoanTypeResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleLoanTypeResource;

class ListVehicleLoanTypes extends ListRecords
{
    protected static string $resource = VehicleLoanTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
