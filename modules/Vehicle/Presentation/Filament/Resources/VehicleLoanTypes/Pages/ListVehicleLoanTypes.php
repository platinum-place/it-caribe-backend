<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleLoanTypes\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleLoanTypes\VehicleLoanTypeResource;

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
