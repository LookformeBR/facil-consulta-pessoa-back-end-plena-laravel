<?php

namespace App\Http\Requests\Paciente;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PacienteEditRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'sometimes|string|max:100',
            'cpf' => ['sometimes', 'string', 'max:20', Rule::unique('paciente')->ignore($this->cpf, 'cpf')],
            'celular' => 'sometimes|string|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'unique' => 'O :attribute já foi usado.',
            'string' => 'O campo :attribute deve ser uma string',
            'max' => 'O campo :attribute não deve ter mais de :max caracteres',
        ];
    }
}
