<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleColorResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleColorResource;

class ListVehicleColors extends ListRecords
{
    protected static string $resource = VehicleColorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
