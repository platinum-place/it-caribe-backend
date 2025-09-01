<?php

namespace App\Filament\Resources\QuoteUnemploymentEmploymentTypes\Pages;

use App\Filament\Resources\QuoteUnemploymentEmploymentTypes\QuoteUnemploymentEmploymentTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageQuoteUnemploymentEmploymentTypes extends ManageRecords
{
    protected static string $resource = QuoteUnemploymentEmploymentTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
