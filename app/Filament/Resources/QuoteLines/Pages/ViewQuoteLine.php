<?php

namespace App\Filament\Resources\QuoteLines\Pages;

use App\Filament\Resources\QuoteLines\QuoteLineResource;
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
