<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCertificadoApiRequest extends FormRequest
{
    public function authorize(): bool
    {
        $perfilIdPermitido = 3; // Id do perfil de gestor
        $unidadeAdministrativaIdPermitida = 1;

        return $this->user()->perfil_id === $perfilIdPermitido
            && $this->user()->unidade_administrativa_id === $unidadeAdministrativaIdPermitida;
    }

    public function rules(): array
    {
        return [
            // ação
            '*.titulo' => 'required|string|max:255',
            '*.inicio' => 'required|date',
            '*.fim' => 'required|date|after_or_equal:*.inicio',
            '*.natureza' => 'required|string',

            // atividades
            '*.atividades' => 'required|array|min:1',
            '*.atividades.*.descricao' => 'required|string',
            '*.atividades.*.inicio' => 'required|date',
            '*.atividades.*.fim' => 'required|date|after_or_equal:*.atividades.*.inicio',

            // participantes
            '*.atividades.*.participantes' => 'required|array|min:1',
            '*.atividades.*.participantes.*.nome' => 'required|string',
            '*.atividades.*.participantes.*.email' => 'required|email',
            '*.atividades.*.participantes.*.cpf' => [
                'required',
                'string',
                'regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/'
            ],
            '*.atividades.*.participantes.*.carga' => 'required|integer|min:1',
            '*.atividades.*.participantes.*.instituicao' => 'required|string',
            '*.atividades.*.participantes.*.curso' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            '*.atividades.*.participantes.*.cpf.regex' =>
                'O campo CPF para o participante deve estar no formato XXX.XXX.XXX-XX.',
        ];
    }
}
