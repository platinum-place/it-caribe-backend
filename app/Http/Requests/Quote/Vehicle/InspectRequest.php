<?php

namespace App\Http\Requests\Quote\Vehicle;

use App\Traits\PrepareForValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class InspectRequest extends FormRequest
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
            'cotz_id' => ['required','integer', 'exists:quote_vehicle_lines,id'],
            'passcode' => ['required', 'string', 'size:4'],
            'Correo' => ['required', 'email'],
            'CantPasajeros' => ['required', 'integer'],
            'Cilindros' => ['required', 'integer'],
            'Odometro' => ['required', 'integer'],
            'unidadOdometro' => ['required', 'string'],
            'Foto1' => ['required', 'string'],
            'Foto2' => ['required', 'string'],
            'Foto3' => ['required', 'string'],
            'Foto4' => ['required', 'string'],
            'Foto5' => ['required', 'string'],
            'Foto6' => ['required', 'string'],
            'Foto7' => ['required', 'string'],
            'Foto8' => ['required', 'string'],
            'Foto9' => ['required', 'string'],
            'Foto13' => ['required', 'string'],
            'Foto10' => ['nullable', 'string'],
            'Foto11' => ['nullable', 'string'],
            'Foto12' => ['nullable', 'string'],
            'Foto14' => ['nullable', 'string'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->setIgnorecase();
    }
}
