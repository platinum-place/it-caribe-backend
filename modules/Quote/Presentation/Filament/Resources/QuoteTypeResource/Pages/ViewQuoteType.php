<?php

namespace Modules\Quote\Presentation\Filament\Resources\QuoteTypeResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Modules\Quote\Presentation\Filament\Resources\QuoteTypeResource;

class ViewQuoteType extends ViewRecord
{
    protected static string $resource = QuoteTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
