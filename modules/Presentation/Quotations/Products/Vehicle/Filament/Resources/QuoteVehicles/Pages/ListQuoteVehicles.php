<?php

namespace Modules\Presentation\Quotations\Products\Vehicle\Filament\Resources\QuoteVehicles\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Presentation\Quotations\Products\Vehicle\Filament\Resources\QuoteVehicles\QuoteVehicleResource;

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
