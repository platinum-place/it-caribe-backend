<?php

namespace App\Http\Requests\Api\Quote;

use App\Traits\PrepareForValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class EstimateFireRequest extends FormRequest
{
    use PrepareForValidationTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'Cuota' => ['required', 'numeric'],
            'Plazo' => ['required', 'integer'],
            'TiempoLaborando' => ['required', 'integer'],
            'idGiroDelNegocio' => ['required', 'integer'],
            'MontoOriginal' => ['required', 'numeric'],
            'idTipoEmpleado' => ['required', 'integer'],
            'FormaDePago' => ['required', 'string', 'in:Mensual,PagoTotal'],
            'FechaEmision' => ['required', 'date_format:Y-m-d,d/m/Y,Y-m-d\TH:i:sP'],
            'FechaVencimiento' => ['required', 'date_format:Y-m-d,d/m/Y,Y-m-d\TH:i:sP'],
            'IdentCliente' => ['required', 'string'],
            'Cliente' => ['required', 'string'],
            'Telefono' => ['required', 'string'],
            'ValorFinanciado' => ['nullable', 'numeric'],
            'Construccion' => ['required', 'boolean'],
            'TipoContruccion' => ['required', 'string', 'in:Superior,SinConstruccion'],
            'Ubicacion' => ['required', 'string'],
            'Error' => ['nullable', 'string'],
            'Codeudor' => ['nullable', 'boolean'],
            'Vida' => ['nullable', 'boolean'],
            'EdadCodeudor' => ['nullable', 'integer'],
            'FinanciarSeguro' => ['nullable', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'Construccion' => $this->boolean('Construccion') ?? $this->boolean('construccion'),
        ]);

        $this->setIgnorecase();
    }
}
