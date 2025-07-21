<?php

namespace App\Filament\Resources\VehicleUseResource\Pages;

use App\Filament\Resources\VehicleUseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVehicleUses extends ListRecords
{
    protected static string $resource = VehicleUseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
