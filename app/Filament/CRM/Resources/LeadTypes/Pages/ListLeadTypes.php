<?php

namespace App\Filament\CRM\Resources\LeadTypes\Pages;

use App\Filament\CRM\Resources\LeadTypes\LeadTypeResource;
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
