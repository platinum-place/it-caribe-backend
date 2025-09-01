<?php

namespace App\Filament\Branch\Resources\QuoteUnemployments\Pages;

use App\Filament\Branch\Resources\QuoteUnemployments\QuoteUnemploymentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListQuoteUnemployments extends ListRecords
{
    protected static string $resource = QuoteUnemploymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
