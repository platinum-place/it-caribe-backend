<?php

namespace Modules\CRM\Presentation\Filament\Resources\DebtorTypeResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\CRM\Presentation\Filament\Resources\DebtorTypeResource;

class EditDebtorType extends EditRecord
{
    protected static string $resource = DebtorTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
