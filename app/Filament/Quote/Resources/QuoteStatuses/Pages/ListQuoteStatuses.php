<?php

namespace App\Filament\Quote\Resources\QuoteStatuses\Pages;

use App\Filament\Quote\Resources\QuoteStatuses\QuoteStatusResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

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
