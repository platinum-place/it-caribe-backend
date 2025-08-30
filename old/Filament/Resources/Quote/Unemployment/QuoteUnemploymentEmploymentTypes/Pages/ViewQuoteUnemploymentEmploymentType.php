<?php

namespace App\Filament\Resources\Quote\Unemployment\QuoteUnemploymentEmploymentTypes\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use old\Filament\Resources\Quote\Unemployment\QuoteUnemploymentEmploymentTypes\QuoteUnemploymentEmploymentTypeResource;

class ViewQuoteUnemploymentEmploymentType extends ViewRecord
{
    protected static string $resource = QuoteUnemploymentEmploymentTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
