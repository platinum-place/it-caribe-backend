<?php

namespace App\Filament\Resources\Location\Branches\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use old\Filament\Resources\Location\Branches\BranchResource;

class ListBranches extends ListRecords
{
    protected static string $resource = BranchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
