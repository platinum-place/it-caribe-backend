<?php

namespace Modules\Presentation\CRM\Filament\Resources\LeadTypes\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Presentation\CRM\Filament\Resources\LeadTypes\LeadTypeResource;

class CreateLeadType extends CreateRecord
{
    protected static string $resource = LeadTypeResource::class;
}
