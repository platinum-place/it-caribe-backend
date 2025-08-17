<?php

namespace App\Filament\Resources\Quotes\Pages;

use App\Filament\Resources\Quotes\QuoteResource;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Resources\Pages\ListRecords;

class ListQuotes extends ListRecords
{
    protected static string $resource = QuoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ActionGroup::make([
                //                CreateAction::make(),

                Action::make('create_vehicle_quote')
                    ->label(__('Vehicle'))
                    ->url(route('filament.admin.resources.quote-vehicles.create')),
            ])
                ->label(__('Estimate'))
                ->button(),
        ];
    }
}
