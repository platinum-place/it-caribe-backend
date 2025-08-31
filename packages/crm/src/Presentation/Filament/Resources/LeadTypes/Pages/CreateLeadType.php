<?php

namespace Root\CRM\Presentation\Filament\Resources\LeadTypes\Pages;

use Filament\Resources\Pages\CreateRecord;
use Root\CRM\Presentation\Filament\Resources\LeadTypes\LeadTypeResource;

class CreateLeadType extends CreateRecord
{
    protected static string $resource = LeadTypeResource::class;
}
