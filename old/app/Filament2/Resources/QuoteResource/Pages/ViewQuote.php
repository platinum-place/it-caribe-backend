<?php

namespace App\Filament\Resources\QuoteResource\Pages;

use app\Enums\Quote\QuoteStatusEnum;
use app\Enums\Quote\QuoteTypeEnum;
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
                    if ($this->record->quote_status_id !== QuoteStatusEnum::APPROVED->value) {
                        switch ($record->quote_type_id) {
                            case QuoteTypeEnum::VEHICLE->value:
                                return route('filament.quote-vehicles.download', ['quote_vehicle' => $this->record->quoteVehicle]);
                                break;

                            case QuoteTypeEnum::LIFE->value:
                                return route('filament.quote-lives.download', ['quote_life' => $this->record->quoteLife]);
                                break;

                            case QuoteTypeEnum::FIRE->value:
                                return route('filament.quote-fires.download', ['quote_fire' => $this->record->quoteFire]);
                                break;

                            case QuoteTypeEnum::UNEMPLOYMENT->value:
                                return route('filament.quote-unemployments.download', ['quote_unemployment' => $this->record->quoteUnemployment]);
                                break;

                            case 6:
                                return route('filament.quote-debt-unemployments.download', ['quote_debt_unemployment' => $this->record->quoteDebtUnemployment]);
                                break;
                        }
                    }

                    if ($this->record->quote_status_id === QuoteStatusEnum::APPROVED->value) {
                        switch ($record->quote_type_id) {
                            case QuoteTypeEnum::VEHICLE->value:
                                return route('filament.quote-vehicles.downloadCertificate', ['quote_vehicle' => $this->record->quoteVehicle]);
                                break;

                            case QuoteTypeEnum::LIFE->value:
                                return route('filament.quote-lives.downloadCertificate', ['quote_life' => $this->record->quoteLife]);
                                break;

                            case QuoteTypeEnum::FIRE->value:
                                return route('filament.quote-fires.downloadCertificate', ['quote_fire' => $this->record->quoteFire]);
                                break;

                            case QuoteTypeEnum::UNEMPLOYMENT->value:
                                return route('filament.quote-unemployments.downloadCertificate', ['quote_unemployment' => $this->record->quoteUnemployment]);
                                break;

                            case 6:
                                return route('filament.quote-debt-unemployments.downloadCertificate', ['quote_debt_unemployment' => $this->record->quoteDebtUnemployment]);
                                break;
                        }
                    }

                    return '';
                })
                ->openUrlInNewTab(),
            Actions\Action::make('emit')
                ->translateLabel()
                ->url(route('filament.admin.resources.quotes.emit', ['record' => $this->record]))
                ->visible(fn () => $this->record->quote_status_id === QuoteStatusEnum::PENDING->value),
            Actions\Action::make('documents')
                ->label(__('Download :name', ['name' => __('Documents')]))
                ->url(function () {
                    $id = $this->record?->selectedLine?->id_crm;

                    return route('filament.quotes.downloadCRMDocuments', ['id' => $id]);
                })
                ->visible(fn () => $this->record->quote_status_id === QuoteStatusEnum::APPROVED->value),
        ];
    }
}
