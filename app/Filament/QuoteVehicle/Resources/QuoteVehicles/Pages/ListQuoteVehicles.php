<?php

namespace App\Filament\QuoteVehicle\Resources\QuoteVehicles\Pages;

use App\Filament\QuoteVehicle\Resources\QuoteVehicleLines\QuoteVehicleLineResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListQuoteVehicles extends ListRecords
{
    protected static string $resource = QuoteVehicleLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
