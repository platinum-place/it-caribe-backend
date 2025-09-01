<?php

namespace App\Filament\Branch\Resources\QuoteLives\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Branch\Resources\QuoteLives\QuoteLifeResource;

class ViewQuoteLife extends ViewRecord
{
    protected static string $resource = QuoteLifeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
