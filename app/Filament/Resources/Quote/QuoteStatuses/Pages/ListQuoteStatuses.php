<?php

namespace App\Filament\Resources\Quote\QuoteStatuses\Pages;

use App\Filament\Resources\Quote\QuoteStatuses\QuoteStatusResource;
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
