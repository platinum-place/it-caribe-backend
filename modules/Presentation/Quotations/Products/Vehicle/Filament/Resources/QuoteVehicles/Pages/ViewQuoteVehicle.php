<?php

namespace Modules\Presentation\Quotations\Products\Vehicle\Filament\Resources\QuoteVehicles\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Presentation\Quotations\Products\Vehicle\Filament\Resources\QuoteVehicles\QuoteVehicleResource;

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
