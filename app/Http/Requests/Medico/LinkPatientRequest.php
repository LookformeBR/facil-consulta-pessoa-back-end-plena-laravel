<?php

namespace App\Http\Requests\Medico;

use App\Models\MedicoPaciente;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class LinkPatientRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'medico_id' => ['required', 'numeric', 'exists:medico,id'],
            'paciente_id' => ['required', 'numeric', 'exists:paciente,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'numeric' => 'O campo :attribute deve ser um número',
            'exists' => 'O :attribute selecionado é inválido',
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator): void {
                $medico = MedicoPaciente::query()
                    ->where('medico_id', $validator->validated()['medico_id'])
                    ->where('paciente_id', $validator->validated()['paciente_id'])
                    ->first();

                if ($medico) {
                    $validator->errors()->add(
                        'exists',
                        'Esse paciente já foi adicionado a esse médico'
                    );
                }
            },
        ];
    }
}
