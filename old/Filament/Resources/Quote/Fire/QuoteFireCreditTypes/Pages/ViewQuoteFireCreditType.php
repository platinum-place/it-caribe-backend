<?php

namespace App\Filament\Resources\Quote\Fire\QuoteFireCreditTypes\Pages;

use old\Filament\Resources\Quote\Fire\QuoteFireCreditTypes\QuoteFireCreditTypeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewQuoteFireCreditType extends ViewRecord
{
    protected static string $resource = QuoteFireCreditTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
