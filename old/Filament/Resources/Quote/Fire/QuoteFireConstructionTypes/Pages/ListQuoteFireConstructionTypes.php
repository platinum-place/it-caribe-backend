<?php

namespace App\Filament\Resources\Quote\Fire\QuoteFireConstructionTypes\Pages;

use old\Filament\Resources\Quote\Fire\QuoteFireConstructionTypes\QuoteFireConstructionTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListQuoteFireConstructionTypes extends ListRecords
{
    protected static string $resource = QuoteFireConstructionTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
