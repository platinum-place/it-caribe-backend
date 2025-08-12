<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleUses\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleUses\VehicleUseResource;

class ListVehicleUses extends ListRecords
{
    protected static string $resource = VehicleUseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
