<?php

namespace App\Filament\Resources\QuoteLines\Pages;

use App\Filament\Resources\QuoteLines\QuoteLineResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListQuoteLines extends ListRecords
{
    protected static string $resource = QuoteLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
