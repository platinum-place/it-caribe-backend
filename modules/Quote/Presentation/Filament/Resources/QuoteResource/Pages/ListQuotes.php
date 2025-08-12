<?php

namespace Modules\Quote\Presentation\Filament\Resources\QuoteResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Quote\Presentation\Filament\Resources\QuoteResource;

class ListQuotes extends ListRecords
{
    protected static string $resource = QuoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ActionGroup::make([
                //                Actions\CreateAction::make(),

                Actions\Action::make('create_vehicle_quote')
                    ->label(__('Vehicle'))
                    ->url(route('filament.vehicle-quote.resources.quote-vehicles.create')),
            ])
                ->label(__('Estimate'))
                ->button(),
        ];
    }
}
