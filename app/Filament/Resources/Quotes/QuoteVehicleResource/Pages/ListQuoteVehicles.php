<?php

namespace App\Filament\Resources\Quotes\QuoteVehicleResource\Pages;

use App\Filament\Resources\Quotes\QuoteVehicleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuoteVehicles extends ListRecords
{
    protected static string $resource = QuoteVehicleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
