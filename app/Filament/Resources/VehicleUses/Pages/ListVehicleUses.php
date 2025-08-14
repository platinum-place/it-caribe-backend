<?php

namespace App\Filament\Resources\VehicleUses\Pages;

use App\Filament\Resources\VehicleUses\VehicleUseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

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
