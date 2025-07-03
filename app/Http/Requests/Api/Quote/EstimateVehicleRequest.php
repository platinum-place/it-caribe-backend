<?php

namespace App\Http\Requests\Api\Quote;

use App\Traits\PrepareForValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class EstimateVehicleRequest extends FormRequest
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
            'NombreCliente' => ['required', 'string', 'max:255'],
            'FechaNacimiento' => ['required', 'date_format:Y-m-d,d/m/Y'],
            'IdCliente' => ['required', 'string', 'max:20'],
            'TelefResidencia' => ['nullable', 'string'],
            'TelefMovil' => ['nullable', 'string'],
            'TelefTrabajo' => ['nullable', 'string'],
            'Marca' => ['required', 'integer', 'exists:vehicle_makes,code'],
            'Modelo' => ['required', 'integer', 'exists:vehicle_models,code'],
            'Anio' => ['required', 'digits:4'],
            'Chasis' => ['required', 'string', 'max:50'],
            'TipoVehiculo' => ['required', 'integer'],
            'MontoAsegurado' => ['required', 'numeric'],
            'UsosGarantiasId' => ['required', 'integer'],
            'Email' => ['nullable', 'email'],
            'Accesorios' => ['nullable', 'array'],
            'Accesorios.*' => ['string'],
            'Actividad' => ['nullable', 'string'],
            'Placa' => ['nullable', 'string', 'max:20'],
            'CirculacionID' => ['nullable', 'array'],
            'CirculacionID.*' => ['integer'],
            'ColorId' => ['nullable', 'array'],
            'ColorId.*' => ['integer'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->setIgnorecase();
    }
}
