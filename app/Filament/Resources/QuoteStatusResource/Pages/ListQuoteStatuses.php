<?php

namespace App\Filament\Resources\QuoteStatusResource\Pages;

use App\Filament\Resources\QuoteStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuoteStatuses extends ListRecords
{
    protected static string $resource = QuoteStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
