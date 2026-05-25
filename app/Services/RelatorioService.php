<?php

namespace App\Services;

use App\Models\Acao;
use App\Models\Atividade;
use App\Models\Certificado;
use App\Models\Natureza;
use App\Models\TipoNatureza;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class RelatorioService
{
    public function getIndexData($user): array
    {
        [$certificados, $acoes] = $this->getBaseAcoesData($user);

        return [
            'naturezas' => Natureza::all(),
            'tipos_natureza' => TipoNatureza::orderBy('descricao')->get(),
            'anos' => $this->getAnosFiltro(),
            'acoes' => $this->decorateAcoes($acoes),
            'total' => count($certificados),
            'certificados' => $certificados,
        ];
    }

    public function getAcoesFiltradas(array $filtros, $user): array
    {
        [$certificados, $acoes] = $this->getBaseAcoesData($user);

        if (!empty($filtros['buscar_acao'])) {
            $certificados = Certificado::search_acao($certificados, $filtros['buscar_acao']);
            $acoes = Acao::search_acao_by_name($acoes, $filtros['buscar_acao']);
        }

        if (!empty($filtros['natureza'])) {
            $certificados = Certificado::search_natureza($certificados, $filtros['natureza']);
            $acoes = Acao::search_acao_by_natureza($acoes, $filtros['natureza']);
        }

        if (!empty($filtros['tipo_natureza'])) {
            $certificados = Certificado::search_tipo_natureza($certificados, $filtros['tipo_natureza']);
            $acoes = Acao::search_acao_by_tipo_natureza($acoes, $filtros['tipo_natureza']);
        }

        if (!empty($filtros['ano'])) {
            $acoes = Acao::search_acao_by_ano($acoes, $filtros['ano']);
            $certificados = [];

            foreach ($acoes as $acao) {
                foreach ($acao->atividades as $atividade) {
                    foreach (Certificado::where('atividade_id', $atividade->id)->get() as $certificado) {
                        $certificados[] = $certificado;
                    }
                }
            }
        }

        return [
            'acoes' => $this->decorateAcoes($acoes),
            'total' => count($certificados),
            'certificados' => $certificados,
        ];
    }

    public function getAtividades($acaoId, array $filtros = []): array
    {
        $acao = Acao::find($acaoId);
        $atividades = $acao ? $acao->atividades()->get() : collect();

        if (!empty($filtros['descricao'])) {
            $atividades = Atividade::search_atividade_by_descricao($atividades, $filtros['descricao']);
        }

        return [
            'acao' => $acao,
            'atividades' => $this->decorateAtividades($atividades),
            'descricoes' => [
                'Avaliador(a)', 'Bolsista', 'Colaborador(a)', 'Comissão Organizadora', 'Conferencista',
                'Coordenador(a)', 'Formador(a)', 'Ministrante', 'Orientador(a)', 'Palestrante',
                'Voluntário(a)', 'Participante', 'Vice-coordenador(a)', 'Ouvinte', 'Apresentação de Trabalho',
            ],
        ];
    }

    private function getBaseAcoesData($user): array
    {
        $perfilId = $user->perfil_id;
        $unidade = $user->unidade_administrativa_id;
        $certificados = collect();
        $acoes = collect();

        if ($perfilId == 1) {
            $certificados = Certificado::all();
            $acoes = Acao::where('status', 'Aprovada')->orderBy('titulo')->get();
        } elseif ($perfilId == 3 && $unidade) {
            $certificados = $this->getCertificadosByUnidade($unidade);
            $acoes = Acao::getAcoesAprovadasAndamento($unidade, 'titulo');
        }

        return [$certificados, $acoes];
    }

    private function getCertificadosByUnidade($unidade): Collection
    {
        $acoes = Acao::getAcoesAprovadasAndamento($unidade, 'titulo');
        $certificados = collect();

        $acoes->each(function ($acao) use ($certificados) {
            $certificados->push($acao->certificados);
        });

        return $certificados->collapse();
    }

    private function decorateAcoes($acoes)
    {
        $acoes->each(function ($acao) {
            $acao->nome_atividades = '';
            $acao->total = 0;

            $acao->atividades->each(function ($atividade) use ($acao) {
                $acao->total += count(Certificado::where('atividade_id', $atividade->id)->get());
                $acao->nome_atividades = $acao->nome_atividades
                    ? $acao->nome_atividades . ', ' . $atividade->descricao
                    : $atividade->descricao;
            });
        });

        return $acoes;
    }

    private function decorateAtividades($atividades)
    {
        $atividades->each(function ($atividade) {
            $atividade->total = count($atividade->certificados);
            $atividade->participantes->each(function ($participante) use ($atividade) {
                $atividade->nome_participantes = !$atividade->nome_participantes
                    ? $participante->user->firstName()
                    : $atividade->nome_participantes . ', ' . $participante->user->firstName();
                $atividade->lista_nomes = $atividade->participantes->map(function ($item) {
                    return $item->user->name;
                })->implode(", \n");
            });
        });

        return $atividades;
    }

    private function getAnosFiltro(): array
    {
        $ano = 2019;
        $anos = [];

        do {
            $ano += 1;
            $anos[] = $ano;
        } while ($ano != Carbon::now()->year);

        return $anos;
    }
}
