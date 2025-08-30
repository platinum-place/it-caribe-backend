<?php

namespace App\Filament\Resources\Quote\Unemployment\QuoteUnemploymentPaymentTypes\Pages;

use App\Filament\Resources\Quote\Unemployment\QuoteUnemploymentPaymentTypes\QuoteUnemploymentPaymentTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditQuoteUnemploymentPaymentType extends EditRecord
{
    protected static string $resource = QuoteUnemploymentPaymentTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
