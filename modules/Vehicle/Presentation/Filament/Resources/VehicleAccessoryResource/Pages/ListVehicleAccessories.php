<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleAccessoryResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleAccessoryResource;

class ListVehicleAccessories extends ListRecords
{
    protected static string $resource = VehicleAccessoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
