<?php

namespace App\Filament\Branch\Resources\QuoteDebtUnemployments\Pages;

use App\Filament\Branch\Resources\QuoteDebtUnemployments\QuoteDebtUnemploymentResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

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
