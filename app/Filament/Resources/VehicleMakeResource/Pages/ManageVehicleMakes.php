<?php

namespace App\Filament\Resources\VehicleMakeResource\Pages;

use App\Filament\Resources\VehicleMakeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageVehicleMakes extends ManageRecords
{
    protected static string $resource = VehicleMakeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
