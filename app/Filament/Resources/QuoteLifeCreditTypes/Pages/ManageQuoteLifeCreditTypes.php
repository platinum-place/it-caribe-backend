<?php

namespace App\Filament\Resources\QuoteLifeCreditTypes\Pages;

use App\Filament\Resources\QuoteLifeCreditTypes\QuoteLifeCreditTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageQuoteLifeCreditTypes extends ManageRecords
{
    protected static string $resource = QuoteLifeCreditTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
