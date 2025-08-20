<?php

namespace App\Filament\Resources\QuoteVehicles\Pages;

use App\Filament\Resources\QuoteVehicles\QuoteVehicleResource;
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
