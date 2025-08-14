<?php

namespace App\Filament\QuoteVehicle\Resources\QuoteVehicles\Pages;

use App\Filament\QuoteVehicle\Resources\QuoteVehicles\QuoteVehicleResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewQuoteVehicle extends ViewRecord
{
    protected static string $resource = QuoteVehicleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
