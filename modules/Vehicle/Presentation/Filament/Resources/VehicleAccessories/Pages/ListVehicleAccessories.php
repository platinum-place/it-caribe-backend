<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleAccessories\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleAccessories\VehicleAccessoryResource;

class ListVehicleAccessories extends ListRecords
{
    protected static string $resource = VehicleAccessoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
