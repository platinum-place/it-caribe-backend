<?php

namespace App\Filament\Resources\Quote\Life\QuoteLifeCreditTypes\Pages;

use App\Filament\Resources\Quote\Life\QuoteLifeCreditTypes\QuoteLifeCreditTypeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewQuoteLifeCreditType extends ViewRecord
{
    protected static string $resource = QuoteLifeCreditTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
