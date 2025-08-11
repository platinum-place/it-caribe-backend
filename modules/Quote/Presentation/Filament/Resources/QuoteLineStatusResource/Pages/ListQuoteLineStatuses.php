<?php

namespace Modules\Quote\Presentation\Filament\Resources\QuoteLineStatusResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Quote\Presentation\Filament\Resources\QuoteLineStatusResource;

class ListQuoteLineStatuses extends ListRecords
{
    protected static string $resource = QuoteLineStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
