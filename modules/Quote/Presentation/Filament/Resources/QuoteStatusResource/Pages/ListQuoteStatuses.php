<?php

namespace Modules\Quote\Presentation\Filament\Resources\QuoteStatusResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Quote\Presentation\Filament\Resources\QuoteStatusResource;

class ListQuoteStatuses extends ListRecords
{
    protected static string $resource = QuoteStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
