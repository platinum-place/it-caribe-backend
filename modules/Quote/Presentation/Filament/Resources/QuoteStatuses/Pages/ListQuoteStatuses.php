<?php

namespace Modules\Quote\Presentation\Filament\Resources\QuoteStatuses\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Quote\Presentation\Filament\Resources\QuoteStatuses\QuoteStatusResource;

class ListQuoteStatuses extends ListRecords
{
    protected static string $resource = QuoteStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
