<?php

namespace App\Filament\Resources\QuoteFireResource\Pages;

use App\Filament\Resources\QuoteFireResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewQuoteFire extends ViewRecord
{
    protected static string $resource = QuoteFireResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
