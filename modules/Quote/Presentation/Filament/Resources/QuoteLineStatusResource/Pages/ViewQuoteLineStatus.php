<?php

namespace Modules\Quote\Presentation\Filament\Resources\QuoteLineStatusResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Modules\Quote\Presentation\Filament\Resources\QuoteLineStatusResource;

class ViewQuoteLineStatus extends ViewRecord
{
    protected static string $resource = QuoteLineStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
