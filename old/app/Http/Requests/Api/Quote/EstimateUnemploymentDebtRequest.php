<?php

namespace App\Http\Requests\Api\Quote;

use App\Traits\PrepareForValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class EstimateUnemploymentDebtRequest extends FormRequest
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
            'MontoOriginal' => ['required', 'numeric'],
            'IdenCliente' => ['required', 'string', 'max:20'],
            'Cliente' => ['required', 'string', 'max:255'],
            'Direccion' => ['required', 'string', 'max:255'],
            'Telefono' => ['required', 'string'],
            'Deuda' => ['nullable', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->setIgnorecase();
    }
}
