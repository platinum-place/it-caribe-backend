<?php

namespace App\Filament\Quote\Resources\QuoteTypes\Pages;

use App\Filament\Quote\Resources\QuoteTypes\QuoteTypeResource;
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
