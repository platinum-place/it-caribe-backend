<?php

namespace Modules\Presentation\Quotations\Products\Unemployment\Filament\Resources\QuoteUnemploymentEmploymentTypes\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Modules\Presentation\Quotations\Products\Unemployment\Filament\Resources\QuoteUnemploymentEmploymentTypes\QuoteUnemploymentEmploymentTypeResource;

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
