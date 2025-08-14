<?php

namespace App\Filament\QuoteVehicle\Resources\QuoteVehicleLines\Pages;

use App\Filament\QuoteVehicle\Resources\QuoteVehicleLines\QuoteVehicleLineResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditQuoteVehicleLine extends EditRecord
{
    protected static string $resource = QuoteVehicleLineResource::class;

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
