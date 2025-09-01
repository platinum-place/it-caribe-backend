<?php

namespace App\Filament\Branch\Resources\QuoteFires\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Branch\Resources\QuoteFires\QuoteFireResource;

class ViewQuoteFire extends ViewRecord
{
    protected static string $resource = QuoteFireResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
