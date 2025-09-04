<?php

namespace Modules\Presentation\Catalogs\Vehicles\Filament\Resources\VehicleUses\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Modules\Presentation\Catalogs\Vehicles\Filament\Resources\VehicleUses\VehicleUseResource;

class ManageVehicleUses extends ManageRecords
{
    protected static string $resource = VehicleUseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
