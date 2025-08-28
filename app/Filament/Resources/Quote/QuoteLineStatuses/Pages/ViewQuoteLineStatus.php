<?php

namespace App\Filament\Resources\Quote\QuoteLineStatuses\Pages;

use App\Filament\Resources\Quote\QuoteLineStatuses\QuoteLineStatusResource;
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
