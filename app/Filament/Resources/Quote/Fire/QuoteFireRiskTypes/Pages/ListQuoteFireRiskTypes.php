<?php

namespace App\Filament\Resources\Quote\Fire\QuoteFireRiskTypes\Pages;

use App\Filament\Resources\Quote\Fire\QuoteFireRiskTypes\QuoteFireRiskTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListQuoteFireRiskTypes extends ListRecords
{
    protected static string $resource = QuoteFireRiskTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
