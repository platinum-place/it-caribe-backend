<?php

namespace App\Filament\Resources\Quote\Unemployment\QuoteUnemploymentEmploymentTypes\Pages;

use App\Filament\Resources\Quote\Unemployment\QuoteUnemploymentEmploymentTypes\QuoteUnemploymentEmploymentTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListQuoteUnemploymentEmploymentTypes extends ListRecords
{
    protected static string $resource = QuoteUnemploymentEmploymentTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
