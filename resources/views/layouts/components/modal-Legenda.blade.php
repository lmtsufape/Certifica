<link rel="stylesheet" href="/css/modelo_certificado/modal-legendas.css">

@php
    $exibirVariaveisPrppgi = Auth::check() && Auth::user()->unidade_administrativa_id == 3;
@endphp

<div class="modal fade" id="modal-Legenda" tabindex="-1" aria-labelledby="modalLegendaTitulo" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header card-header header-legenda">
                <h3 class="modal-title" id="modalLegendaTitulo">Variáveis do certificado</h3>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>

            <div class="modal-body card-body">
                <ul class="nav nav-tabs variaveis-tabs" id="variaveisCertificadoTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="variaveis-gerais-tab" data-bs-toggle="tab"
                            data-bs-target="#variaveis-gerais" type="button" role="tab"
                            aria-controls="variaveis-gerais" aria-selected="true">
                            Variáveis gerais
                        </button>
                    </li>
                    @if ($exibirVariaveisPrppgi)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="variaveis-unidade-tres-tab" data-bs-toggle="tab"
                                data-bs-target="#variaveis-unidade-tres" type="button" role="tab"
                                aria-controls="variaveis-unidade-tres" aria-selected="false">
                                PRPPGI
                            </button>
                        </li>
                    @endif
                </ul>

                <div class="tab-content variaveis-tab-content" id="variaveisCertificadoConteudo">
                    <div class="tab-pane fade show active" id="variaveis-gerais" role="tabpanel"
                        aria-labelledby="variaveis-gerais-tab" tabindex="0">
                        <p class="variaveis-description">Variáveis disponíveis para os modelos de certificado em geral.</p>
                        <ul class="variaveis-list">
                            <li><b>Nome do participante</b><code>%participante%</code></li>
                            <li><b>Nome da ação institucional</b><code>%acao%</code></li>
                            <li><b>Tipo da atividade</b><code>%atividade%</code></li>
                            <li><b>Título da atividade</b><code>%titulo_atividade%</code></li>
                            <li><b>Nome da atividade</b><code>%nome_atividade%</code></li>
                            <li><b>Data de início</b><code>%data_inicio%</code></li>
                            <li><b>Data de fim</b><code>%data_fim%</code></li>
                            <li><b>Carga horária</b><code>%carga_horaria%</code></li>
                            <li><b>Natureza da ação</b><code>%natureza%</code></li>
                            <li><b>Tipo da natureza da ação</b><code>%tipo_natureza%</code></li>
                            <li><b>Texto em negrito</b><code>*frase/palavra/tag*</code></li>
                            <li><b>Título do trabalho</b><code>%titulo_trabalho%</code></li>
                            <li><b>Autores do trabalho</b><code>%autores_trabalho%</code></li>
                            <li><b>Coautores do trabalho</b><code>%coautores_trabalho%</code></li>
                            <li><b>Curso do participante</b><code>%curso%</code></li>
                            <li><b>Orientador da atividade</b><code>%orientador%</code></li>
                            <li><b>Disciplina</b><code>%disciplina%</code></li>
                            <li><b>Período letivo</b><code>%periodo_letivo%</code></li>
                            <li><b>Área de atuação</b><code>%area%</code></li>
                            <li><b>Local da atividade</b><code>%local_realizado%</code></li>
                            <li><b>Título do projeto</b><code>%titulo_projeto%</code></li>
                        </ul>
                    </div>

                    @if ($exibirVariaveisPrppgi)
                        <div class="tab-pane fade" id="variaveis-unidade-tres" role="tabpanel"
                            aria-labelledby="variaveis-unidade-tres-tab" tabindex="0">
                            <p class="variaveis-description">
                                Dados individuais cadastrados para participantes pelo Gestor Institucional da PRPPGI.
                            </p>
                            <ul class="variaveis-list variaveis-list-exclusive">
                                <li><b>Título do plano</b><code>%titulo_plano%</code></li>
                                <li><b>CPF do orientador</b><code>%cpf_orientador%</code></li>
                                <li><b>Nome do orientador</b><code>%nome_orientador%</code></li>
                                <li><b>E-mail do orientador</b><code>%email_orientador%</code></li>
                                <li><b>Tipo da natureza informado para o participante</b><code>%tipo_natureza_participante%</code></li>
                                <li><b>Data de início</b><code>%inicio%</code></li>
                                <li><b>Data de término</b><code>%termino%</code></li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
