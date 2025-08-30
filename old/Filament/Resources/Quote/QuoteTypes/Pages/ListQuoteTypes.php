<?php

namespace App\Filament\Resources\Quote\QuoteTypes\Pages;

use old\Filament\Resources\Quote\QuoteTypes\QuoteTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListQuoteTypes extends ListRecords
{
    protected static string $resource = QuoteTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
