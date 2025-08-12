<?php

namespace Modules\CRM\Presentation\Filament\Resources\Debtors\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\CRM\Presentation\Filament\Resources\Debtors\DebtorResource;

class ViewDebtor extends ViewRecord
{
    protected static string $resource = DebtorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
