<?php

namespace App\Filament\Resources\QuoteStatuses\Pages;

use App\Filament\Resources\QuoteStatuses\QuoteStatusResource;
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
