<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleUtilities\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleUtilities\VehicleUtilityResource;

class ListVehicleUtilities extends ListRecords
{
    protected static string $resource = VehicleUtilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
