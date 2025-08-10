<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleUtilityResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleUtilityResource;

class ListVehicleUtilities extends ListRecords
{
    protected static string $resource = VehicleUtilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
