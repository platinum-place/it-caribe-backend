<?php

namespace App\Filament\Resources\QuoteUnemploymentPaymentTypes\Pages;

use App\Filament\Resources\QuoteUnemploymentPaymentTypes\QuoteUnemploymentPaymentTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

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
