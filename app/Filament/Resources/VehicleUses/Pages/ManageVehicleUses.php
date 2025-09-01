<?php

namespace App\Filament\Resources\VehicleUses\Pages;

use App\Filament\Resources\VehicleUses\VehicleUseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

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
