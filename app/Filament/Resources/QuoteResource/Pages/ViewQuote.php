<?php

namespace App\Filament\Resources\QuoteResource\Pages;

use App\Enums\QuoteStatus;
use App\Enums\QuoteType;
use App\Filament\Resources\QuoteResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewQuote extends ViewRecord
{
    protected static string $resource = QuoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\Action::make('download')
                ->translateLabel()
                ->url(function ($record) {
                    if ($this->record->quote_status_id !== QuoteStatus::APPROVED->value) {
                        switch ($record->quote_type_id) {
                            case QuoteType::VEHICLE->value:
                                return route('filament.quote-vehicles.download', ['quote_vehicle' => $this->record->quoteVehicle]);
                                break;

                            case QuoteType::LIFE->value:
                                return route('filament.quote-lives.download', ['quote_life' => $this->record->quoteLife]);
                                break;
                        }
                    }

                    if ($this->record->quote_status_id === QuoteStatus::APPROVED->value) {
                        switch ($record->quote_type_id) {
                            case QuoteType::VEHICLE->value:
                                return route('filament.quote-vehicles.downloadCertificate', ['quote_vehicle' => $this->record->quoteVehicle]);
                                break;

                            case QuoteType::LIFE->value:
                                return route('filament.quote-lives.downloadCertificate', ['quote_life' => $this->record->quoteLife]);
                                break;
                        }
                    }

                    return '';
                })
                ->openUrlInNewTab(),
            Actions\Action::make('emit')
                ->translateLabel()
                ->url(route('filament.admin.resources.quotes.emit', ['record' => $this->record]))
                ->visible(fn () => $this->record->quote_status_id === QuoteStatus::PENDING->value),
            Actions\Action::make('documents')
                ->label(__('Download :name', ['name' => __('Documents')]))
                ->url(function () {
                    $id = $this->record?->selectedLine?->id_crm;

                    return route('filament.quotes.downloadCRMDocuments', ['id' => $id]);
                })
                ->visible(fn () => $this->record->quote_status_id === QuoteStatus::APPROVED->value),
        ];
    }
}
