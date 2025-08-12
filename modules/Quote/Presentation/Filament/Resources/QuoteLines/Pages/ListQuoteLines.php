<?php

namespace Modules\Quote\Presentation\Filament\Resources\QuoteLines\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Quote\Presentation\Filament\Resources\QuoteLines\QuoteLineResource;

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
