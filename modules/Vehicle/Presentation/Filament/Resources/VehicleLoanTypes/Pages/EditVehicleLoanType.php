<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleLoanTypes\Pages;

use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleLoanTypes\VehicleLoanTypeResource;

class EditVehicleLoanType extends EditRecord
{
    protected static string $resource = VehicleLoanTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
