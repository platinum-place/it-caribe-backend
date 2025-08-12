<?php

namespace Modules\CRM\Presentation\Filament\Resources\Debtors\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\CRM\Presentation\Filament\Resources\Debtors\DebtorResource;

class CreateDebtor extends CreateRecord
{
    protected static string $resource = DebtorResource::class;
}
