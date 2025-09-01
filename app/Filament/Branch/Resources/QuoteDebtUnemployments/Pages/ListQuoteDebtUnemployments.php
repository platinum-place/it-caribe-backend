<?php

namespace App\Filament\Branch\Resources\QuoteDebtUnemployments\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Branch\Resources\QuoteDebtUnemployments\QuoteDebtUnemploymentResource;

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
