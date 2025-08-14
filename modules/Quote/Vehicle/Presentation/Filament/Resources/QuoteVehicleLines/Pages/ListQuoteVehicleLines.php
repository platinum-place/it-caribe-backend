<?php

namespace Modules\Quote\Vehicle\Presentation\Filament\Resources\QuoteVehicleLines\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Quote\Vehicle\Presentation\Filament\Resources\QuoteVehicleLines\QuoteVehicleLineResource;

class ListQuoteVehicleLines extends ListRecords
{
    protected static string $resource = QuoteVehicleLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
