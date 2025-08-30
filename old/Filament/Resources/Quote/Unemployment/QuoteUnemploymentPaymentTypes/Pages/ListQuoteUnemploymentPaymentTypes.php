<?php

namespace App\Filament\Resources\Quote\Unemployment\QuoteUnemploymentPaymentTypes\Pages;

use App\Filament\Resources\Quote\Unemployment\QuoteUnemploymentPaymentTypes\QuoteUnemploymentPaymentTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListQuoteUnemploymentPaymentTypes extends ListRecords
{
    protected static string $resource = QuoteUnemploymentPaymentTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
