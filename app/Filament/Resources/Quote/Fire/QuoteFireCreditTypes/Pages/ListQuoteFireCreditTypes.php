<?php

namespace App\Filament\Resources\Quote\Fire\QuoteFireCreditTypes\Pages;

use App\Filament\Resources\Quote\Fire\QuoteFireCreditTypes\QuoteFireCreditTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListQuoteFireCreditTypes extends ListRecords
{
    protected static string $resource = QuoteFireCreditTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
