<?php

namespace Modules\Quote\Presentation\Filament\Resources\QuoteTypes\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Quote\Presentation\Filament\Resources\QuoteTypes\QuoteTypeResource;

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
