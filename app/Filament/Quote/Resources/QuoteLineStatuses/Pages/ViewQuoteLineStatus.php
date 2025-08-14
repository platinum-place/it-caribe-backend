<?php

namespace App\Filament\Quote\Resources\QuoteLineStatuses\Pages;

use App\Filament\Quote\Resources\QuoteLineStatuses\QuoteLineStatusResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewQuoteLineStatus extends ViewRecord
{
    protected static string $resource = QuoteLineStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
