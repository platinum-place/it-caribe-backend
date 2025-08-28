<?php

namespace old\Resources\QuoteVehicles\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use old\Resources\QuoteVehicles\QuoteVehicleResource;

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
