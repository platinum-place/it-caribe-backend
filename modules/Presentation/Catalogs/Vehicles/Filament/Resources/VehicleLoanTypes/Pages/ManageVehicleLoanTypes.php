<?php

namespace Modules\Presentation\Catalogs\Vehicles\Filament\Resources\VehicleLoanTypes\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Modules\Presentation\Catalogs\Vehicles\Filament\Resources\VehicleLoanTypes\VehicleLoanTypeResource;

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
