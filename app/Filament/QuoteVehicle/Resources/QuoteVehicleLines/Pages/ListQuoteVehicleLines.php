<?php

namespace App\Filament\QuoteVehicle\Resources\QuoteVehicleLines\Pages;

use App\Filament\QuoteVehicle\Resources\QuoteVehicleLines\QuoteVehicleLineResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

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
