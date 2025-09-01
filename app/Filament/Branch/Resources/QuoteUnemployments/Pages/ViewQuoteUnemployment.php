<?php

namespace App\Filament\Branch\Resources\QuoteUnemployments\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Branch\Resources\QuoteUnemployments\QuoteUnemploymentResource;

class ViewQuoteUnemployment extends ViewRecord
{
    protected static string $resource = QuoteUnemploymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
