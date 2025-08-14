<?php

namespace App\Filament\Quote\Resources\QuoteLineStatuses\Pages;

use App\Filament\Quote\Resources\QuoteLineStatuses\QuoteLineStatusResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

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
