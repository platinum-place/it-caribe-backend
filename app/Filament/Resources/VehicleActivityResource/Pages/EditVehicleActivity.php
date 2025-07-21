<?php

namespace App\Filament\Resources\VehicleActivityResource\Pages;

use App\Filament\Resources\VehicleActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVehicleActivity extends EditRecord
{
    protected static string $resource = VehicleActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
