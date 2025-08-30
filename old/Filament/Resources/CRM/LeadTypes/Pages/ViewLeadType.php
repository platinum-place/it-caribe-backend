<?php

namespace App\Filament\Resources\CRM\LeadTypes\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use old\Filament\Resources\CRM\LeadTypes\LeadTypeResource;

class ViewLeadType extends ViewRecord
{
    protected static string $resource = LeadTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
