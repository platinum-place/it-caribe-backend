<?php

namespace Modules\Presentation\Quotations\Products\Life\Filament\Resources\QuoteLives\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Presentation\Quotations\Products\Life\Filament\Resources\QuoteLives\QuoteLifeResource;

class ViewQuoteLife extends ViewRecord
{
    protected static string $resource = QuoteLifeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
