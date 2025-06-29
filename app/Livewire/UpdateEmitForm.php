<?php

namespace App\Livewire;

use App\Filament\Pages\Emit;
use App\Helpers\Cotizaciones;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Component;

class UpdateEmitForm extends Component implements HasForms
{
    use InteractsWithForms;

    public array $data = [];

    public ?int $id = 0;

    // Solo datos serializables (arrays, strings, int, bool)
    public array $insuranceOptions = [];

    public string $customerName = '';

    public string $customerDocument = '';

    public bool $dataLoaded = false;

    public function mount(int $id): void
    {
        $this->id = $id;
        $this->loadQuoteData();
        $this->form->fill();
    }

    private function loadQuoteData(): void
    {
        if (! $this->dataLoaded) {
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

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('documentos')
                    ->label('Adjuntar documentos')
                    ->multiple()
                    ->required()
                    ->maxSize(10240)
                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                    ->disk('local')
                    ->directory('documentos'),
            ])
            ->statePath('data')
            ->live();
    }

    public function hydrate(): void
    {
        $this->loadQuoteData();
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $libreria = new Cotizaciones;

        foreach ($data['documentos'] as $documento) {
            $libreria->uploadAttachment('Quotes', $this->id, \Storage::path($documento));
        }

        $this->redirect(Emit::getUrl(['id' => $this->id]));

        Notification::make()
            ->title(__('Success'))
            ->success()
            ->send();

        $this->form->fill();
    }

    public function render()
    {
        return view('livewire.update-emit-form');
    }
}
