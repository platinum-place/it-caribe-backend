<?php

namespace Modules\Presentation\Quotations\Products\Unemployment\Filament\Resources\QuoteUnemployments\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Presentation\Quotations\Products\Unemployment\Filament\Resources\QuoteUnemployments\QuoteUnemploymentResource;

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
