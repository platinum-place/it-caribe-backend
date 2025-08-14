<?php

namespace App\Filament\Resources\QuoteTypes\Pages;

use App\Filament\Resources\QuoteTypes\QuoteTypeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewQuoteType extends ViewRecord
{
    protected static string $resource = QuoteTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
