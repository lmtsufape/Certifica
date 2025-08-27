<?php

namespace App\Services;

use App\Jobs\GerarCertificadosJob;
use App\Models\Acao;
use App\Models\Curso;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Throwable;

class CertificadoApiService
{
    // Constantes movidas para o serviço, onde a lógica de negócio reside.
    private const PERFIL_ID_PADRAO = 3;
    private const UNIDADE_ADMINISTRATIVA_ID_PADRAO = 1;
    private const NATUREZA_ID_PADRAO = 1;
    private const CURSO_ID_PADRAO = 8;

    /**
     * Orquestra a criação de ações, atividades e participantes.
     *
     * @param array $dadosValidados
     * @return array
     * @throws \Exception
     */
    public function criarCertificados(array $dadosValidados): array
    {
        $user = auth()->user();

        return DB::transaction(function () use ($dadosValidados, $user) {
            $acoesCriadas = [];
            foreach ($dadosValidados as $dadosAcao) {
                $acao = $this->criarAcao($dadosAcao, $user);

                foreach ($dadosAcao['atividades'] as $dadosAtividade) {
                    $this->criarAtividadeComParticipantes($acao, $dadosAtividade);
                }

                GerarCertificadosJob::dispatch($acao);
                $acoesCriadas[] = $acao;
            }
            return $acoesCriadas;
        });
    }

    private function criarAcao(array $dadosAcao, User $user): Acao
    {
        return Acao::create([
            'titulo' => $dadosAcao['acao']['titulo'],
            'data_inicio' => $dadosAcao['acao']['data_inicio'],
            'data_fim' => $dadosAcao['acao']['data_fim'],
            'tipo_natureza' => $dadosAcao['tipo_natureza'],
            'natureza_id' => self::NATUREZA_ID_PADRAO,
            'usuario_id' => $user->id,
        ]);
    }

    private function criarAtividadeComParticipantes(Acao $acao, array $dadosAtividade): void
    {
        $atividade = $acao->atividades()->create([
            'descricao' => $dadosAtividade['descricao'],
            'data_inicio' => $dadosAtividade['data_inicio'],
            'data_fim' => $dadosAtividade['data_fim'],
        ]);

        foreach ($dadosAtividade['participantes'] as $dadosParticipante) {
            $cursoId = $this->getCursoIdPeloNome($dadosParticipante['curso'] ?? null);

            $atividade->participantes()->create([
                'cpf' => $dadosParticipante['cpf'],
                'email' => $dadosParticipante['email'],
                'nome' => $dadosParticipante['nome'],
                'carga_horaria' => $dadosParticipante['carga_horaria'],
                'instituicao' => $dadosParticipante['instituicao'],
                'passaporte' => $dadosParticipante['passaporte'] ?? null,
                'json_cursos_ids' => json_encode([$cursoId]),
                'tipo' => $dadosAtividade['descricao'],
                'disciplina' => $dadosParticipante['disciplina'] ?? null,
                'orientador' => $dadosParticipante['orientador'] ?? null,
                'periodo_letivo' => $dadosParticipante['periodo_letivo'] ?? null,
                'area' => $dadosParticipante['area'] ?? null,
                'local_realizado' => $dadosParticipante['local_realizado'] ?? null,
                'titulo_projeto' => $dadosParticipante['titulo_projeto'] ?? null,
            ]);
        }
    }

    private function getCursoIdPeloNome(?string $nomeCurso): int
    {
        if (!$nomeCurso) {
            return self::CURSO_ID_PADRAO;
        }

        $curso = cache()->remember("curso_id_{$nomeCurso}", now()->addHour(), function () use ($nomeCurso) {
            return Curso::where('nome', $nomeCurso)->first();
        });

        return $curso->id ?? self::CURSO_ID_PADRAO;
    }
}
