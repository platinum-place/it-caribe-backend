<?php

namespace App\Filament\Resources\Location\Branches\Pages;

use App\Filament\Resources\Location\Branches\BranchResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

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
