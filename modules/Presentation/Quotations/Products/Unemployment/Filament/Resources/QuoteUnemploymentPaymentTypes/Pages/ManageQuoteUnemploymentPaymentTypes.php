<?php

namespace Modules\Presentation\Quotations\Products\Unemployment\Filament\Resources\QuoteUnemploymentPaymentTypes\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Modules\Presentation\Quotations\Products\Unemployment\Filament\Resources\QuoteUnemploymentPaymentTypes\QuoteUnemploymentPaymentTypeResource;

class ManageQuoteUnemploymentPaymentTypes extends ManageRecords
{
    protected static string $resource = QuoteUnemploymentPaymentTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
