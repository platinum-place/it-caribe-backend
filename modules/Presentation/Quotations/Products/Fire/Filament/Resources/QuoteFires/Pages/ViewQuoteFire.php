<?php

namespace Modules\Presentation\Quotations\Products\Fire\Filament\Resources\QuoteFires\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Presentation\Quotations\Products\Fire\Filament\Resources\QuoteFires\QuoteFireResource;

class ViewQuoteFire extends ViewRecord
{
    protected static string $resource = QuoteFireResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
