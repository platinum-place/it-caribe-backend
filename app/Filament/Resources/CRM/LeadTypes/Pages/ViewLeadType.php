<?php

namespace App\Filament\Resources\CRM\LeadTypes\Pages;

use App\Filament\Resources\CRM\LeadTypes\LeadTypeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

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
