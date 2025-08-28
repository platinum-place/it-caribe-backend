<?php

namespace old\Resources\Quotes\Pages;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Resources\Pages\ListRecords;
use old\Resources\Quotes\QuoteResource;

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
