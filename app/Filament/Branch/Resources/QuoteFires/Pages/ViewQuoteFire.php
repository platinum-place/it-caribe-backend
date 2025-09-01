<?php

namespace App\Filament\Branch\Resources\QuoteFires\Pages;

use App\Filament\Branch\Resources\QuoteFires\QuoteFireResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

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
