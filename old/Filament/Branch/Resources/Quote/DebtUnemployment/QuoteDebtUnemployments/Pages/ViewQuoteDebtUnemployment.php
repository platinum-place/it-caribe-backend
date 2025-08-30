<?php

namespace App\Filament\Branch\Resources\Quote\DebtUnemployment\QuoteDebtUnemployments\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use old\Filament\Branch\Resources\Quote\DebtUnemployment\QuoteDebtUnemployments\QuoteDebtUnemploymentResource;

class ViewQuoteDebtUnemployment extends ViewRecord
{
    protected static string $resource = QuoteDebtUnemploymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
