<?php

namespace App\Filament\Resources\CRM\LeadTypes\Pages;

use old\Filament\Resources\CRM\LeadTypes\LeadTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLeadTypes extends ListRecords
{
    protected static string $resource = LeadTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
