<?php

namespace App\Http\Requests\Paciente;

use Illuminate\Foundation\Http\FormRequest;

class PacienteStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:100',
            'cpf' => 'required|string|max:20|unique:paciente',
            'celular' => 'required|string|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'unique' => 'O :attribute já foi usado.',
            'required' => 'O campo :attribute é obrigatório',
            'string' => 'O campo :attribute deve ser uma string',
            'max' => 'O campo :attribute não deve ter mais de :max caracteres',
        ];
    }
}
