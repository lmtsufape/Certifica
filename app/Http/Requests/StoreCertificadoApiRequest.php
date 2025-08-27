<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCertificadoApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        $perfilIdPermitido = 3; // Id do perfil de gestor
        $unidadeAdministrativaIdPermitida = 1;

        return $this->user()->perfil_id === $perfilIdPermitido
            && $this->user()->unidade_administrativa_id === $unidadeAdministrativaIdPermitida;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            // ações
            '*.acao' => 'required|array',
            '*.acao.titulo' => 'required|string|max:255',
            '*.acao.data_inicio' => 'required|date',
            '*.acao.data_fim' => 'required|date|after_or_equal:*.acao.data_inicio',
            '*.acao.tipo_natureza' => 'required|string',

            // atividades
            '*.acao.atividades' => 'required|array|min:1',
            '*.acao.atividades.*.descricao' => 'required|string',
            '*.acao.atividades.*.data_inicio' => 'required|date',
            '*.acao.atividades.*.data_fim' => 'required|date|after_or_equal:*.acao.atividades.*.data_inicio',

            // participantes
            '*.acao.atividades.*.participantes' => 'required|array|min:1',
            '*.acao.atividades.*.participantes.*.nome' => 'required|string',
            '*.acao.atividades.*.participantes.*.email' => 'required|email',
            '*.acao.atividades.*.participantes.*.cpf' => 'required|string', // pode trocar por regra de CPF
            '*.acao.atividades.*.participantes.*.carga_horaria' => 'required|integer|min:1',
            '*.acao.atividades.*.participantes.*.instituicao' => 'required|string',
            '*.acao.atividades.*.participantes.*.curso' => 'nullable|string',
        ];
    }
}
