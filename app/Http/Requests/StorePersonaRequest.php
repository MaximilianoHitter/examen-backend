<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonaRequest extends FormRequest
{
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required',
            'apellido' => 'required',
            'dni' => 'required|numeric|gt:1000000|lt:999999999|unique:personas,dni',
            'genero' => 'required|in:masculino,femenino',
            'edad' => 'required|numeric'
        ];
    }
}
