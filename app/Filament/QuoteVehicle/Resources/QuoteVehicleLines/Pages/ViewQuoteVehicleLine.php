<?php

namespace App\Filament\QuoteVehicle\Resources\QuoteVehicleLines\Pages;

use App\Filament\QuoteVehicle\Resources\QuoteVehicleLines\QuoteVehicleLineResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewQuoteVehicleLine extends ViewRecord
{
    protected static string $resource = QuoteVehicleLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
