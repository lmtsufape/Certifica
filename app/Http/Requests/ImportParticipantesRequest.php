<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Maatwebsite\Excel\Facades\Excel;

class ImportParticipantesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'participantes_xlsx' => 'required|file|mimes:xlsx'
        ];
    }

    public function messages()
    {
        return [
            'participantes_xlsx.required' => 'O arquivo é obrigatório.',
            'participantes_xlsx.mimes' => 'O arquivo deve ser do tipo .xlsx.'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->isNotEmpty()) {
                return;
            }

            $file = $this->file('participantes_xlsx');
            $data = Excel::toArray([], $file);

            if (empty($data[0])) {
                $validator->errors()->add('participantes_xlsx', 'O arquivo está vazio ou inválido.');
            }

            // Validar os cabeçalhos
            $expectedHeaders = ['NOME', 'CPF', 'E-MAIL', 'CH'];
            $fileHeaders = $data[0][0] ?? [];
            if ($fileHeaders !== $expectedHeaders) {
                $validator->errors()->add('participantes_xlsx', 'Os cabeçalhos do arquivo não são válidos.');
            }
        });
    }
}
