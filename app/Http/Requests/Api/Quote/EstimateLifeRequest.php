<?php

namespace App\Http\Requests\Api\Quote;

use App\Traits\PrepareForValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class EstimateLifeRequest extends FormRequest
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
            'FechaEmision' => ['required', 'date_format:Y-m-d,d/m/Y,Y-m-d\TH:i:sP'],
            'FechaVencimiento' => ['required', 'date_format:Y-m-d,d/m/Y,Y-m-d\TH:i:sP'],
            'Edad' => ['required', 'integer'],
            'PlazoAnios' => ['required', 'integer'],
            'PlazoDias' => ['required', 'numeric'],
            'MontoOriginal' => ['required', 'numeric'],
            'NombreCliente' => ['required', 'string', 'max:255'],
            'IdenCliente' => ['required', 'string', 'max:50'],
            'FechaNacimiento' => ['required', 'date'],
            'Telefono1' => ['required', 'string'],
            'Direccion' => ['required', 'string', 'max:255'],
            'codeudor' => ['nullable', 'boolean'],
            'EdadCodeudor' => ['nullable', 'integer'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->setIgnorecase();
    }
}
