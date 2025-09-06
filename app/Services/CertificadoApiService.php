<?php

namespace App\Services;

use App\Jobs\GerarCertificadosJob;
use App\Models\Acao;
use App\Models\Curso;
use App\Models\TipoNatureza;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Throwable;

class CertificadoApiService
{
    private const UNIDADE_ADMINISTRATIVA_ID_PADRAO = 1;
    private const CURSO_ID_PADRAO = 8;
    private const PERFIL_ID_PADRAO_NOVO_USUARIO = 4; // Perfil de Participante
    private const NATUREZA_ID_PADRAO = 1; // ID padrão para a natureza
    private const INSTITUICAO_ID_PADRAO = 1; // Na criação de novo usuário

    /**
     * Orquestra a criação de ações, atividades e participantes.
     *
     * @param array $dadosValidados
     * @return array
     * @throws \Exception
     */
    public function criarCertificados(array $dadosValidados): array
    {
        $userRequisitante = auth()->user();

        return DB::transaction(function () use ($dadosValidados, $userRequisitante) {
            $acoesCriadas = [];
            foreach ($dadosValidados as $dadosAcao) {
                $acao = $this->getOrCreateAcao($dadosAcao, $userRequisitante);

                foreach ($dadosAcao['atividades'] as $dadosAtividade) {
                    $this->criarAtividadeComParticipantes($acao, $dadosAtividade);
                }

                GerarCertificadosJob::dispatch($acao);
                $acoesCriadas[] = $acao;
            }
            return $acoesCriadas;
        });
    }

    private function getOrCreateAcao(array $dadosAcao, User $user): Acao
    {
        return Acao::firstOrCreate(
            [
                'titulo' => $dadosAcao['titulo'],
                'usuario_id' => $user->id
            ],
            [
                'data_inicio' => $dadosAcao['inicio'],
                'data_fim' => $dadosAcao['fim'],
                'tipo_natureza_id' => $this->getOrCreateTipoNatureza($dadosAcao['natureza']),
                'unidade_administrativa_id' => self::UNIDADE_ADMINISTRATIVA_ID_PADRAO,
            ]
        );
    }

    private function criarAtividadeComParticipantes(Acao $acao, array $dadosAtividade): void
    {
        $atividade = $acao->atividades()->create([
            'descricao' => $dadosAtividade['descricao'],
            'data_inicio' => $dadosAtividade['inicio'],
            'data_fim' => $dadosAtividade['fim'],
        ]);

        foreach ($dadosAtividade['participantes'] as $dadosParticipante) {
            $userParticipante = $this->getOrCreateUser($dadosParticipante);
            $cursoId = $this->getCursoIdPeloNome($dadosParticipante['curso'] ?? null);

            $atividade->participantes()->create([
                'user_id' => $userParticipante->id,
                'cpf' => $userParticipante->cpf,
                'email' => $userParticipante->email,
                'nome' => $userParticipante->name,
                'carga_horaria' => $dadosParticipante['carga'],
                // 'instituicao' => $dadosParticipante['instituicao'],
                // 'json_cursos_ids' => json_encode([$cursoId]),
            ]);
        }
    }


    /**
     * Encontra um utilizador pelo CPF. Se não existir, cria um novo com uma senha aleatória segura.
     * O CPF é limpo, removendo qualquer formatação.
     *
     * @param array $dadosParticipante
     * @return User
     */
    private function getOrCreateUser(array $dadosParticipante): User
    {
        // Utiliza o método firstOrCreate para evitar duplicados.
        return User::firstOrCreate(
            ['cpf' => $dadosParticipante['cpf']],
            [
                'name' => $dadosParticipante['nome'],
                'email' => $dadosParticipante['email'],
                'password' => Hash::make(Str::random(20)), // Gera e encripta uma senha forte
                'perfil_id' => self::PERFIL_ID_PADRAO_NOVO_USUARIO,
                'cpf' => $dadosParticipante['cpf'],
                'instituicao_id' => self::INSTITUICAO_ID_PADRAO
            ]
        );
    }

    private function getCursoIdPeloNome(?string $nomeCurso): int
    {
        if (!$nomeCurso) {
            return self::CURSO_ID_PADRAO;
        }

        // Adiciona cache para evitar múltiplas consultas ao banco pelo mesmo curso.
        $curso = cache()->remember("curso_id_{$nomeCurso}", now()->addHour(), function () use ($nomeCurso) {
            return Curso::where('nome', $nomeCurso)->first();
        });

        return $curso->id ?? self::CURSO_ID_PADRAO;
    }

    private function getOrCreateTipoNatureza(string $descricao): TipoNatureza
    {
        // Encontra o tipo de natureza pela descrição.
        // Se não existir, cria um novo, definindo também o natureza_id padrão.
        return TipoNatureza::firstOrCreate(
            ['descricao' => $descricao],
            ['natureza_id' => self::NATUREZA_ID_PADRAO]
        );
    }
}
