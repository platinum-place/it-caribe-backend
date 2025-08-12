<?php

namespace Modules\Quote\Presentation\Filament\Resources\QuoteLineStatuses\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Quote\Presentation\Filament\Resources\QuoteLineStatuses\QuoteLineStatusResource;

class ListQuoteLineStatuses extends ListRecords
{
    protected static string $resource = QuoteLineStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
