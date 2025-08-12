<?php

namespace Modules\Quote\Presentation\Filament\Resources\QuoteTypes\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Quote\Presentation\Filament\Resources\QuoteTypes\QuoteTypeResource;

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
