<?php

namespace App\Filament\Resources\Quote\QuoteStatuses\Pages;

use App\Filament\Resources\Quote\QuoteStatuses\QuoteStatusResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewQuoteStatus extends ViewRecord
{
    protected static string $resource = QuoteStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
