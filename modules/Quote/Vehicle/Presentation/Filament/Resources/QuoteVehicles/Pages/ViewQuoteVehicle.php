<?php

namespace Modules\Quote\Vehicle\Presentation\Filament\Resources\QuoteVehicles\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Quote\Vehicle\Presentation\Filament\Resources\QuoteVehicles\QuoteVehicleResource;

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
