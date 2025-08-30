<?php

namespace App\Filament\Resources\CRM\LeadTypes\Pages;

use old\Filament\Resources\CRM\LeadTypes\LeadTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditLeadType extends EditRecord
{
    protected static string $resource = LeadTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
