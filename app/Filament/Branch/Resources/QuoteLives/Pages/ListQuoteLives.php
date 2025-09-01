<?php

namespace App\Filament\Branch\Resources\QuoteLives\Pages;

use App\Filament\Branch\Resources\QuoteLives\QuoteLifeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListQuoteLives extends ListRecords
{
    protected static string $resource = QuoteLifeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
