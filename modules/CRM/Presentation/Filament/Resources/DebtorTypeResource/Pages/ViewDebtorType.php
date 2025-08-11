<?php

namespace Modules\CRM\Presentation\Filament\Resources\DebtorTypeResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Modules\CRM\Presentation\Filament\Resources\DebtorTypeResource;

class ViewDebtorType extends ViewRecord
{
    protected static string $resource = DebtorTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
