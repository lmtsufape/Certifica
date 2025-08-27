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
            '*.acao' => 'required|array',
            '*.acao.titulo' => 'required|string|max:255',
            '*.acao.data_inicio' => 'required|date',
            '*.acao.data_fim' => 'required|date|after_or_equal:*.acao.data_inicio',
            '*.tipo_natureza' => 'required|string',
            '*.atividades' => 'required|array|min:1',
            '*.atividades.*.descricao' => 'required|string',
            '*.atividades.*.data_inicio' => 'required|date',
            '*.atividades.*.data_fim' => 'required|date|after_or_equal:*.atividades.*.data_inicio',
            '*.atividades.*.participantes' => 'required|array|min:1',
            '*.atividades.*.participantes.*.nome' => 'required|string',
            '*.atividades.*.participantes.*.email' => 'required|email',
            '*.atividades.*.participantes.*.cpf' => 'required|string', // Considere adicionar uma regra de validação de CPF
            '*.atividades.*.participantes.*.carga_horaria' => 'required|integer',
            '*.atividades.*.participantes.*.instituicao' => 'required|string',
            '*.atividades.*.participantes.*.curso' => 'nullable|string',
        ];
    }
}
