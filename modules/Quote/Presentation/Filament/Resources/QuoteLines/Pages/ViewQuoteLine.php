<?php

namespace Modules\Quote\Presentation\Filament\Resources\QuoteLines\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Quote\Presentation\Filament\Resources\QuoteLines\QuoteLineResource;

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
