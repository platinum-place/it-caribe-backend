<?php

namespace App\Filament\Branch\Resources\Quote\Fire\QuoteFires\Pages;

use App\Filament\Branch\Resources\Quote\Fire\QuoteFires\QuoteFireResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListQuoteFires extends ListRecords
{
    protected static string $resource = QuoteFireResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
