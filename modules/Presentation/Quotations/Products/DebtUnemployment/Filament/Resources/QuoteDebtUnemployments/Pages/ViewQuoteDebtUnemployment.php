<?php

namespace Modules\Presentation\Quotations\Products\DebtUnemployment\Filament\Resources\QuoteDebtUnemployments\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Presentation\Quotations\Products\DebtUnemployment\Filament\Resources\QuoteDebtUnemployments\QuoteDebtUnemploymentResource;

class ViewQuoteDebtUnemployment extends ViewRecord
{
    protected static string $resource = QuoteDebtUnemploymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
