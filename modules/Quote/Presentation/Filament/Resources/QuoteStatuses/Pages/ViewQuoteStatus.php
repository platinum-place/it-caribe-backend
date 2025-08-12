<?php

namespace Modules\Quote\Presentation\Filament\Resources\QuoteStatuses\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Quote\Presentation\Filament\Resources\QuoteStatuses\QuoteStatusResource;

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
