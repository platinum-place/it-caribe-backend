<?php

namespace App\Filament\Resources\Vehicle\VehicleModelResource\Pages;

use App\Filament\Imports\Vehicle\VehicleModelImporter;
use App\Filament\Resources\Vehicle\VehicleModelResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageVehicleModels extends ManageRecords
{
    protected static string $resource = VehicleModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\ImportAction::make()
                ->importer(VehicleModelImporter::class)
                ->label(__('Import :name', ['name' => __('Vehicle models')]))
                ->modalHeading(__('Import :name', ['name' => __('Vehicle models')])),
        ];
    }
}
