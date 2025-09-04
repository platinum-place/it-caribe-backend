<?php

namespace Modules\Presentation\Catalogs\Vehicles\Filament\Resources\Vehicles\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Presentation\Catalogs\Vehicles\Filament\Resources\Vehicles\VehicleResource;

class ListVehicles extends ListRecords
{
    protected static string $resource = VehicleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
