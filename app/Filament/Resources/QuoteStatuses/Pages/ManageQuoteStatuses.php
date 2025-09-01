<?php

namespace App\Filament\Resources\QuoteStatuses\Pages;

use App\Filament\Resources\QuoteStatuses\QuoteStatusResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageQuoteStatuses extends ManageRecords
{
    protected static string $resource = QuoteStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
