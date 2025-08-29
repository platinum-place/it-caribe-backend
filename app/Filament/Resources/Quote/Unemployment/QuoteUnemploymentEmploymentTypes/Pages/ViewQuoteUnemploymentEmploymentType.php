<?php

namespace App\Filament\Resources\Quote\Unemployment\QuoteUnemploymentEmploymentTypes\Pages;

use App\Filament\Resources\Quote\Unemployment\QuoteUnemploymentEmploymentTypes\QuoteUnemploymentEmploymentTypeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

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
