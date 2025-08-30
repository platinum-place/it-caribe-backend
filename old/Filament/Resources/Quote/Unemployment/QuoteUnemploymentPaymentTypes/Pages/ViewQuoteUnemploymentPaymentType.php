<?php

namespace App\Filament\Resources\Quote\Unemployment\QuoteUnemploymentPaymentTypes\Pages;

use App\Filament\Resources\Quote\Unemployment\QuoteUnemploymentPaymentTypes\QuoteUnemploymentPaymentTypeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewQuoteUnemploymentPaymentType extends ViewRecord
{
    protected static string $resource = QuoteUnemploymentPaymentTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
