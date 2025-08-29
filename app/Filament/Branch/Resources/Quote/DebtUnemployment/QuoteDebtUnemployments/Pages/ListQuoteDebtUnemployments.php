<?php

namespace App\Filament\Branch\Resources\Quote\DebtUnemployment\QuoteDebtUnemployments\Pages;

use App\Filament\Branch\Resources\Quote\DebtUnemployment\QuoteDebtUnemployments\QuoteDebtUnemploymentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListQuoteDebtUnemployments extends ListRecords
{
    protected static string $resource = QuoteDebtUnemploymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
