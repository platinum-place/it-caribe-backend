<?php

namespace App\Filament\Branch\Resources\QuoteVehicles\Pages;

use App\Filament\Branch\Resources\QuoteVehicles\QuoteVehicleResource;
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
