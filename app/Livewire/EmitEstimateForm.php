<?php

namespace App\Livewire;

use App\Filament\Pages\Emit;
use App\Helpers\Cotizaciones;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Livewire\WithFileUploads;

class EmitEstimateForm extends Component implements HasForms
{
    use InteractsWithForms, WithFileUploads;

    public array $data = [];

    public ?int $id = 0;

    // Solo datos serializables (arrays, strings, int, bool)
    public array $insuranceOptions = [];

    public string $customerName = '';

    public string $customerDocument = '';

    public bool $dataLoaded = false;

    public ?string $selectedInsurance = null;

    // Propiedad para manejar los archivos subidos
    public $documentos = [];

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
                Select::make('planid')
                    ->label('Aseguradora')
                    ->options($this->insuranceOptions)
                    ->live()
                    ->afterStateUpdated(fn ($state) => $this->selectedInsurance = $state)
                    ->required(),

                Checkbox::make('acuerdo')
                    ->label(fn () => new \Illuminate\Support\HtmlString(
                        'Estoy de acuerdo que quiero emitir la cotización, a nombre de <b>'.
                        $this->customerName.'</b>, RNC/Cédula <b>'.
                        $this->customerDocument.'</b>'
                    ))
                    ->live()
                    ->required(),
            ])
            ->statePath('data')
            ->live();
    }

    public function hydrate(): void
    {
        $this->loadQuoteData();
    }

    public function updatedDocumentos()
    {
        // Validar archivos en tiempo real cuando se seleccionan
        $this->validate([
            'documentos.*' => 'file|mimes:pdf,jpg,jpeg,png,gif|max:10240',
        ], [
            'documentos.*.file' => 'El archivo debe ser válido.',
            'documentos.*.mimes' => 'Solo se permiten archivos PDF e imágenes.',
            'documentos.*.max' => 'El archivo no puede ser mayor a 10MB.',
        ]);
    }

    public function getDownloadUrl(): ?string
    {
        if (!$this->selectedInsurance) {
            return null;
        }

        return route('filament.resources.estimate.condicionado', $this->selectedInsurance);
    }

    public function create(): void
    {
        // Validar que se hayan subido documentos
        $this->validate([
            'documentos' => 'required|array|min:1',
            'documentos.*' => 'file|mimes:pdf,jpg,jpeg,png,gif|max:10240', // 10MB max
        ], [
            'documentos.required' => 'Debe adjuntar al menos un documento.',
            'documentos.min' => 'Debe adjuntar al menos un documento.',
            'documentos.*.file' => 'El archivo debe ser válido.',
            'documentos.*.mimes' => 'Solo se permiten archivos PDF e imágenes.',
            'documentos.*.max' => 'El archivo no puede ser mayor a 10MB.',
        ]);

        $data = $this->form->getState();

        $libreria = new Cotizaciones;

        $cotizacion = $libreria->getRecord('Quotes', $this->id);

        $libreria->actualizar_cotizacion($cotizacion, $data['planid']);

        // Procesar los archivos subidos
        foreach ($this->documentos as $documento) {
            try {
                // Opción 1: Usar el archivo temporal directamente
                $tempPath = $documento->getRealPath();

                if (file_exists($tempPath)) {
                    // Subir directamente desde el archivo temporal
                    $libreria->uploadAttachment('Quotes', $this->id, $tempPath);
                } else {
                    // Opción 2: Guardar temporalmente y usar Storage::path
                    $path = $documento->store('temp-documents');
                    $fullPath = \Storage::path($path);

                    if (file_exists($fullPath)) {
                        $libreria->uploadAttachment('Quotes', $this->id, $fullPath);
                        \Storage::delete($path);
                    } else {
                        throw new \Exception('No se pudo acceder al archivo: ' . $documento->getClientOriginalName());
                    }
                }
            } catch (\Exception $e) {
                \Log::error('Error procesando archivo: ' . $e->getMessage());
                throw new \Exception('Error procesando el archivo ' . $documento->getClientOriginalName() . ': ' . $e->getMessage());
            }
        }

        $this->redirect(Emit::getUrl(['id' => $this->id]));
    }

    public function render()
    {
        return view('livewire.emit-estimate-form');
    }
}
