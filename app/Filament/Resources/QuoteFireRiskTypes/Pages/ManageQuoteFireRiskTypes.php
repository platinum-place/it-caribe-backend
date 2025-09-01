<?php

namespace App\Filament\Resources\QuoteFireRiskTypes\Pages;

use App\Filament\Resources\QuoteFireRiskTypes\QuoteFireRiskTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageQuoteFireRiskTypes extends ManageRecords
{
    protected static string $resource = QuoteFireRiskTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
