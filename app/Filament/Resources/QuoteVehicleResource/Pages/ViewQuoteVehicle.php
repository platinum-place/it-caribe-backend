<?php

namespace App\Filament\Resources\QuoteVehicleResource\Pages;

use App\Filament\Resources\QuoteVehicleResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewQuoteVehicle extends ViewRecord
{
    protected static string $resource = QuoteVehicleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
