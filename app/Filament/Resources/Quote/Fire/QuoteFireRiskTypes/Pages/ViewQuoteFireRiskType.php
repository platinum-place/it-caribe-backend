<?php

namespace App\Filament\Resources\Quote\Fire\QuoteFireRiskTypes\Pages;

use App\Filament\Resources\Quote\Fire\QuoteFireRiskTypes\QuoteFireRiskTypeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewQuoteFireRiskType extends ViewRecord
{
    protected static string $resource = QuoteFireRiskTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
