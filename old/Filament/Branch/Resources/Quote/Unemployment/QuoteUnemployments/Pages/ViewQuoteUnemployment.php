<?php

namespace App\Filament\Branch\Resources\Quote\Unemployment\QuoteUnemployments\Pages;

use old\Filament\Branch\Resources\Quote\Unemployment\QuoteUnemployments\QuoteUnemploymentResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewQuoteUnemployment extends ViewRecord
{
    protected static string $resource = QuoteUnemploymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
