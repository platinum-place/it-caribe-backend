<?php

namespace App\Filament\Resources\QuoteTypes\Pages;

use App\Filament\Resources\QuoteTypes\QuoteTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageQuoteTypes extends ManageRecords
{
    protected static string $resource = QuoteTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
