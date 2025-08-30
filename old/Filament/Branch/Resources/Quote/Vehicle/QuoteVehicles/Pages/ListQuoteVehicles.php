<?php

namespace App\Filament\Branch\Resources\Quote\Vehicle\QuoteVehicles\Pages;

use old\Filament\Branch\Resources\Quote\Vehicle\QuoteVehicles\QuoteVehicleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListQuoteVehicles extends ListRecords
{
    protected static string $resource = QuoteVehicleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
