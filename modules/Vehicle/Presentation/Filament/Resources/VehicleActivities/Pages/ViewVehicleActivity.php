<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleActivities\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleActivities\VehicleActivityResource;

class ViewVehicleActivity extends ViewRecord
{
    protected static string $resource = VehicleActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
