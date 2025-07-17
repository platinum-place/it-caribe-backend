<?php

namespace App\Filament\Resources\Quotes\QuoteVehicleResource\Pages;

use App\Enums\Quotes\QuoteLineStatus;
use App\Enums\Quotes\QuoteStatus;
use App\Filament\Resources\Quotes\QuoteVehicleResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewQuoteVehicle extends ViewRecord
{
    protected static string $resource = QuoteVehicleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\Action::make('download')
                ->translateLabel()
                ->url(route('filament.quote-vehicles.download', ['quote_vehicle' => $this->record]))
                ->openUrlInNewTab()
                ->visible(fn () => $this->record->quote->quote_status_id !== QuoteStatus::APPROVED->value),
            Actions\Action::make('download')
                ->label(__('Download :name', ['name' => __('Issuance')]))
                ->url(route('filament.quote-vehicles.downloadCertificate', ['quote_vehicle' => $this->record]))
                ->openUrlInNewTab()
                ->visible(fn () => $this->record->quote->quote_status_id === QuoteStatus::APPROVED->value),
            Actions\Action::make('emit')
                ->translateLabel()
                ->url(route('filament.admin.resources.quotes.quote-vehicles.emit', ['record' => $this->record]))
                ->visible(fn () => $this->record->quote->quote_status_id === QuoteStatus::PENDING->value),
            Actions\Action::make('documents')
                ->label(__('Download :name', ['name' => __('Documents')]))
                ->url(function () {
                    $id = $this->record->quote->lines
                        ->where('quote_line_status_id', QuoteLineStatus::ACCEPTED->value)
                        ->first()
                        ?->id_crm;

                    return route('filament.zoho-crm.download-product-attachments', ['id' => $id]);
                })
                ->visible(fn () => $this->record->quote->quote_status_id === QuoteStatus::APPROVED->value),
        ];
    }
}
