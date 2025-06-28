<?php

namespace App\Filament\Resources\Vehicle\VehicleMakeResource\Pages;

use App\Filament\Imports\Vehicle\VehicleMakeImporter;
use App\Filament\Resources\Vehicle\VehicleMakeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageVehicleMakes extends ManageRecords
{
    protected static string $resource = VehicleMakeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\ImportAction::make()
                ->importer(VehicleMakeImporter::class)
                ->label(__('Import :name', ['name' => __('Vehicle makes')]))
                ->modalHeading(__('Import :name', ['name' => __('Vehicle makes')])),
        ];
    }
}
