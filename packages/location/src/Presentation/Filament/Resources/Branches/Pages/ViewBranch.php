<?php

namespace Root\Location\Presentation\Filament\Resources\Branches\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Root\Location\Presentation\Filament\Resources\Branches\BranchResource;

class ViewBranch extends ViewRecord
{
    protected static string $resource = BranchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
