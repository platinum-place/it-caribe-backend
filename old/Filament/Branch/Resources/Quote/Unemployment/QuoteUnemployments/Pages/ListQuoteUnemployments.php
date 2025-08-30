<?php

namespace App\Filament\Branch\Resources\Quote\Unemployment\QuoteUnemployments\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use old\Filament\Branch\Resources\Quote\Unemployment\QuoteUnemployments\QuoteUnemploymentResource;

class ListQuoteUnemployments extends ListRecords
{
    protected static string $resource = QuoteUnemploymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
