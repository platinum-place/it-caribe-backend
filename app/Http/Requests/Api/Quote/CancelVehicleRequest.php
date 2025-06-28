<?php

namespace App\Http\Requests\Api\Quote;

use App\Traits\PrepareForValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class CancelVehicleRequest extends FormRequest
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
            'IdCotizacion' => ['required', 'uuid'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->setIgnorecase();
    }
}
