<?php

namespace Modules\Quote\Presentation\Filament\Resources\Quotes\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Quote\Presentation\Filament\Resources\Quotes\QuoteResource;

class ViewQuote extends ViewRecord
{
    protected static string $resource = QuoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
