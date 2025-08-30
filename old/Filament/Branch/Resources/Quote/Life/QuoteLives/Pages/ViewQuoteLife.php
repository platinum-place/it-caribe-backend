<?php

namespace App\Filament\Branch\Resources\Quote\Life\QuoteLives\Pages;

use old\Filament\Branch\Resources\Quote\Life\QuoteLives\QuoteLifeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewQuoteLife extends ViewRecord
{
    protected static string $resource = QuoteLifeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
