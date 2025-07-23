<?php

namespace App\Filament\Resources\QuoteLifeResource\Pages;

use App\Filament\Resources\QuoteLifeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewQuoteLife extends ViewRecord
{
    protected static string $resource = QuoteLifeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
