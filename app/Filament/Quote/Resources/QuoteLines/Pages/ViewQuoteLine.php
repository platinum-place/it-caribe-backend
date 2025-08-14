<?php

namespace App\Filament\Quote\Resources\QuoteLines\Pages;

use App\Filament\Quote\Resources\QuoteLines\QuoteLineResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewQuoteLine extends ViewRecord
{
    protected static string $resource = QuoteLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
