<?php

namespace Modules\Quote\Presentation\Filament\Resources\Quotes\Pages;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Quote\Presentation\Filament\Resources\Quotes\QuoteResource;

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
                    ->url(route('filament.vehicle-quote.resources.quote-vehicles.create')),
            ])
                ->label(__('Estimate'))
                ->button(),
        ];
    }
}
