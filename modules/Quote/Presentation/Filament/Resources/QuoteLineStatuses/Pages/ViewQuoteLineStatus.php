<?php

namespace Modules\Quote\Presentation\Filament\Resources\QuoteLineStatuses\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Quote\Presentation\Filament\Resources\QuoteLineStatuses\QuoteLineStatusResource;

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
