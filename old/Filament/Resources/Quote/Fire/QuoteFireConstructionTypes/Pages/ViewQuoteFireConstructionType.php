<?php

namespace App\Filament\Resources\Quote\Fire\QuoteFireConstructionTypes\Pages;

use old\Filament\Resources\Quote\Fire\QuoteFireConstructionTypes\QuoteFireConstructionTypeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewQuoteFireConstructionType extends ViewRecord
{
    protected static string $resource = QuoteFireConstructionTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
