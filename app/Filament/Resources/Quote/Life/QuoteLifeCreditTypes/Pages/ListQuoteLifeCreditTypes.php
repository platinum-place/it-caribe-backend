<?php

namespace App\Filament\Resources\Quote\Life\QuoteLifeCreditTypes\Pages;

use App\Filament\Resources\Quote\Life\QuoteLifeCreditTypes\QuoteLifeCreditTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListQuoteLifeCreditTypes extends ListRecords
{
    protected static string $resource = QuoteLifeCreditTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
