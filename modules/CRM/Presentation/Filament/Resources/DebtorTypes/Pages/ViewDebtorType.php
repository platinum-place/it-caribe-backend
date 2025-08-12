<?php

namespace Modules\CRM\Presentation\Filament\Resources\DebtorTypes\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\CRM\Presentation\Filament\Resources\DebtorTypes\DebtorTypeResource;

class ViewDebtorType extends ViewRecord
{
    protected static string $resource = DebtorTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
