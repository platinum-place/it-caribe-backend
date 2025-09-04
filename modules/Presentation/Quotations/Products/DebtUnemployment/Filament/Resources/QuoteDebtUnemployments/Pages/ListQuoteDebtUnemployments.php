<?php

namespace Modules\Presentation\Quotations\Products\DebtUnemployment\Filament\Resources\QuoteDebtUnemployments\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Presentation\Quotations\Products\DebtUnemployment\Filament\Resources\QuoteDebtUnemployments\QuoteDebtUnemploymentResource;

class ListQuoteDebtUnemployments extends ListRecords
{
    protected static string $resource = QuoteDebtUnemploymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
