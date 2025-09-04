<?php

namespace Modules\Presentation\Quotations\Products\Fire\Filament\Resources\QuoteFireRiskTypes\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Modules\Presentation\Quotations\Products\Fire\Filament\Resources\QuoteFireRiskTypes\QuoteFireRiskTypeResource;

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
