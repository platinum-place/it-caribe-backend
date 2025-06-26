<?php

namespace App\Filament\Pages;

use App\Helpers\Cotizaciones;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Illuminate\Http\Request;

class Estimate extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.estimate';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function getSlug(): string
    {
        return 'estimate/{id}';
    }

    public ?int $id = 0;

    // Propiedades para los datos del formulario
    public array $insuranceOptions = [];
    public string $customerName = '';
    public string $customerDocument = '';
    public bool $dataLoaded = false;

    public function mount(int $id): void
    {
        $this->id = $id;
        $this->loadQuoteData();
    }

    private function loadQuoteData(): void
    {
        if (!$this->dataLoaded) {
            $libreria = new Cotizaciones;
            $quote = $libreria->getRecord('Quotes', $this->id);

            if ($quote) {
                // Convertir a datos serializables
                $this->insuranceOptions = collect($quote->getLineItems())
                    ->filter(fn ($item) => $item->getNetTotal() > 0)
                    ->mapWithKeys(fn ($item) => [
                        $item->getProduct()->getEntityId() => $item->getProduct()->getLookupLabel().' (RD$'.number_format($item->getNetTotal(), 2).')',
                    ])
                    ->toArray();

                $this->customerName = $quote->getFieldValue('Nombre').' '.$quote->getFieldValue('Apellido');
                $this->customerDocument = $quote->getFieldValue('RNC_C_dula');
                $this->dataLoaded = true;
            }
        }
    }

    public function getInsuranceOptions(): array
    {
        return $this->insuranceOptions;
    }

    public function getCustomerName(): string
    {
        return $this->customerName;
    }

    public function getCustomerDocument(): string
    {
        return $this->customerDocument;
    }

    public static function getNavigationLabel(): string
    {
        return __('Quote');
    }

    public function getHeading(): string
    {
        return __('Quote');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('download')
                ->translateLabel()
                ->url(route('filament.resources.estimate.download', ['id' => $this->id]))
                ->openUrlInNewTab(),
        ];
    }
}
