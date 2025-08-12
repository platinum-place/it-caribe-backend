<?php

namespace Modules\Quote\Submodules\Vehicle\Presentation\Filament\Resources\QuoteVehicleLines\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Quote\Submodules\Vehicle\Presentation\Filament\Resources\QuoteVehicleLines\QuoteVehicleLineResource;

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
