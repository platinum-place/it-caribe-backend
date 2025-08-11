<?php

namespace Modules\Quote\Submodules\Vehicle\Presentation\Filament\Resources\QuoteVehicleResource\Pages;

use Modules\Quote\Submodules\Vehicle\Presentation\Filament\Resources\QuoteVehicleResource;
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
