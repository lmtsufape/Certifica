@extends('layouts.app')

@section('title')
    Atividades
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/list.css">
    <link rel="stylesheet" href="/css/cadastros/cadastrarAtividade.css">
@endsection

@section('content')
    <section class="view-list-acoes">

        <div class="container">

            <h1 class="text-center mb-4">Ação institucional: {{ $acao->titulo }}</h1>

            <div class="text-center mb-3">
                <h3>Atividades / funções</h3>
            </div>


            <div class="row d-flex align-items-center justify-content-between">

                <div class="col-1">
                    <a type="button" class="button d-flex align-items-center justify-content-around between"
                        href="{{ route('acao.index') }}">
                        Voltar
                        <img src="/images/acoes/listView/voltar.svg" alt="">
                    </a>
                </div>

                <div class="col-8 text-end">
                    @if ($acao->status == null || $acao->status == 'Devolvida' || Auth::user()->perfil_id == 3)
                        <a class="criar-acao-button" data-bs-toggle="modal" data-bs-target="#modalComponent">
                            <img class="iconAdd" src="/images/acoes/listView/criar.svg" alt=""> Criar atividade
                        </a>
                    @endif
                </div>
            </div>

            @php
                $tituloModal = 'Cadastrar Atividade';
            @endphp

            <x-modal-component :title="$tituloModal">
                <form id="atividadeForm" action="{{ route('atividade.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="acao_id" value="{{ $acao->id }}">
                    <input type="text" class="form-control" name="titulo" value="{{ $acao->titulo }}" hidden>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="descricao" class="form-label">Atividade / Função<span class="ast"
                                    style="color: red;">*</span></label>
                            <select class="form-control" name="descricao" id="select_atividade">
                                <option value="" selected hidden>Escolher...</option>
                                @foreach ($tipos_ordenados as $tipo)
                                    <option value="{{ $tipo }}">{{ $tipo }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col">
                            <label for="titulo" class="form-label">Título da Atividade</label>
                            <input type="text" class="form-control" name="titulo">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="data_inicio" class="form-label">Data de Início<span class="ast"
                                    style="color: red;">*</span></label>
                            <input type="date" class="form-control" name="data_inicio">
                        </div>
                        <div class="col">
                            <label for="data_fim" class="form-label">Data de Término<span class="ast"
                                    style="color: red;">*</span></label>
                            <input type="date" class="form-control" name="data_fim">
                        </div>
                    </div>
                </form>
            </x-modal-component>

            <script>
                document.getElementById('submitFormButton').addEventListener('click', function() {
                    document.getElementById('atividadeForm').submit(); // Envia o formulário quando "Cadastrar" for clicado
                });
            </script>

            <div class="row head-table d-flex align-items-center justify-content-center">
                <div class="col-2"><span class="spacing-col">Atividade / Função</span></div>
                <div class="col-2"><span>Período</span></div>
                <div class="col-6"><span>Integrantes</span></div>
                <div class="col-2 text-center"><span>Funcionalidades</span></div>
            </div>
        </div>

        <div class="list container">
            @foreach ($atividades as $atividade)
                <div class="row linha-table d-flex align-items-center justify-content-center">
                    <div class="col-2"><span class="spacing-col">{{ $atividade->descricao }}</span></div>
                    <div class="col-2">
                        <span>{{ collect(explode('-', $atividade->data_inicio))->reverse()->join('/') .
                            ' - ' .
                            collect(explode('-', $atividade->data_fim))->reverse()->join('/') }}</span>
                    </div>

                    <div class="col-6 titulo-span" title="{{ $atividade->lista_nomes }}">
                        {{ $atividade->nome_participantes }}
                    </div>

                    <div class="col-2 d-flex align-items-center justify-content-center gap-2">
                        @if ($atividade->descricao === 'Apresentação de Trabalho')
                            <a href="{{ route('trabalho.index', ['atividade_id' => $atividade->id]) }}" title="Trabalhos">
                                <img src="/images/acoes/listView/clipboard-check.svg" alt="">
                            </a>
                        @else
                            <a href="{{ route('participante.index', ['atividade_id' => $atividade->id]) }}"
                                title="Integrantes">
                                <img src="/images/atividades/participantes.svg" alt="">
                            </a>
                        @endif

                        @if ($acao->status == null || $acao->status == 'Devolvida')
                            @if (!($atividade->descricao === 'Apresentação de Trabalho'))
                                <a href="/files/modelo.xlsx" title="Baixar Modelo">
                                    <img src="/images/acoes/listView/anexo.svg">
                                </a>

                                <a href="" title="Importar Integrantes" data-bs-toggle="modal"
                                    data-bs-target="#modalImportCsv{{ $atividade->id }}">
                                    <img src="/images/acoes/listView/csvIcon.svg" alt="">
                                </a>
                            @else
                                <a href="/files/modelo_trabalho.xlsx" title="Baixar Modelo Trabalho">
                                    <img src="/images/acoes/listView/anexo.svg">
                                </a>

                                <a href="" title="Importar Autores/Coautores" data-bs-toggle="modal"
                                    data-bs-target="#modalImportTrabalhoCsv{{ $atividade->id }}">
                                    <img src="/images/acoes/listView/csvIcon.svg" alt="">
                                </a>
                            @endif

                            <a href="{{ route('atividade.edit', ['atividade_id' => $atividade->id]) }}" title="Editar">
                                <img src="/images/acoes/listView/editar.svg" alt="">
                            </a>

                            <a onclick="return confirm('Você tem certeza que deseja remover a atividade?')"
                                href="{{ route('atividade.delete', ['atividade_id' => $atividade->id]) }}"
                                title="Excluir">
                                <img src="/images/acoes/listView/lixoIcon.svg" alt="">
                            </a>
                        @elseif(Auth::user()->perfil_id == 3)
                            <a href="{{ route('atividade.edit', ['atividade_id' => $atividade->id]) }}" title="Editar">
                                <img src="/images/acoes/listView/editar.svg" alt="">
                            </a>
                        @endif

                        @if (Auth::user()->perfil_id == 3)
                            @if ($acao->status == 'Aprovada')
                                @if ($atividade->descricao !== 'Apresentação de Trabalho')
                                    <a href="/files/modelo.xlsx" title="Baixar Modelo">
                                        <img src="/images/acoes/listView/anexo.svg">
                                    </a>

                                    <a href="" title="Importar Integrantes" data-bs-toggle="modal"
                                        data-bs-target="#modalImportCsv{{ $atividade->id }}">
                                        <img src="/images/acoes/listView/csvIcon.svg" alt="">
                                    </a>

                                    <a onclick="return confirm('Você tem certeza que deseja remover a atividade?')"
                                        href="{{ route('atividade.delete', ['atividade_id' => $atividade->id]) }}"
                                        title="Excluir">
                                        <img src="/images/acoes/listView/lixoIcon.svg" alt="">
                                    </a>
                                @else
                                    <a href="/files/modelo_trabalho.xlsx" title="Baixar Modelo Trabalho">
                                        <img src="/images/acoes/listView/anexo.svg">
                                    </a>

                                    <a href="" title="Importar Autores/Coautores" data-bs-toggle="modal"
                                        data-bs-target="#modalImportTrabalhoCsv{{ $atividade->id }}">
                                        <img src="/images/acoes/listView/csvIcon.svg" alt="">
                                    </a>

                                    <a onclick="return confirm('Você tem certeza que deseja remover a atividade?')"
                                        href="{{ route('atividade.delete', ['atividade_id' => $atividade->id]) }}"
                                        title="Excluir">
                                        <img src="/images/acoes/listView/lixoIcon.svg" alt="">
                                    </a>
                                @endif
                            @endif

                            @if ($atividade->emissao_parcial($atividade->id))
                                <a href="{{ Route('gestor.gerar_certificados_parcial', ['atividade_id' => $atividade->id]) }}"
                                    onclick="return confirm('Você tem certeza que deseja emitir os certificados desta atividade?')">
                                    <img src="/images/acoes/listView/submeter.svg" alt="emitir certificados"
                                        title="Emitir Certificados">
                                </a>
                            @endif
                        @endif

                    </div>
                </div>





                <!-- Modal -->
                <div class="modal fade" id="modalImportCsv{{ $atividade->id }}" tabindex="-1"
                    aria-labelledby="modalImportCsvLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalImportCsvLabel">Importar XLSX com os Dados dos
                                    Integrantes
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>


                            <div class="modal-body">
                                <div class="container">
                                    <form class="form"
                                        action="{{ Route('import_participantes', ['atividade_id' => $atividade->id]) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row align-items-start">
                                            <div>
                                                <input type="file" accept=".xlsx" name="participantes_xlsx"
                                                    id="participantes_xlsx" class="form-control form-control-sm"
                                                    style="margin-top:5%" required>
                                            </div>
                                        </div>
                                        <div class="card  mt-3">
                                            <div class="card-header text-white" style="background-color: #972E3F">
                                                <strong>Instruções para Importação</strong>
                                            </div>
                                            <div class="card-body">
                                                <ul class="list-unstyled">
                                                    <li><i class="bi bi-check-circle text-success"></i> O arquivo deve
                                                        estar no formato <strong>XLSX</strong>, utilizado pelo Microsoft
                                                        Excel.</li>
                                                    <li><i class="bi bi-check-circle text-success"></i> O cabeçalho deve
                                                        conter apenas: <strong>NOME, CPF, E-MAIL, CH</strong>. Consulte o <a
                                                            href="/files/modelo.xlsx">modelo de exemplo</a> para
                                                        referência.</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="justify-content-end mt-4">
                                            <button type="button" class="btn btn-sm btn-dark"
                                                data-bs-dismiss="modal">Fechar</button>
                                            <button type="submit" class="btn btn-sm"
                                                style="background-color: #972E3F; color:white">Importar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modalImportTrabalhoCsv{{ $atividade->id }}" tabindex="-1"
                    aria-labelledby="modalImportCsvLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalImportCsvLabel">Importar XLSX com os Dados dos Trabalhos
                                    e
                                    Autores
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>


                            <div class="modal-body">
                                <div class="container">
                                    <form class="form"
                                        action="{{ Route('import_trabalhos', ['atividade_id' => $atividade->id]) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row align-items-start">
                                            <div>
                                                <input type="file" accept=".xlsx" name="trabalhos_xlsx"
                                                    id="trabalhos_xlsx" class="form-control form-control-sm"
                                                    style="margin-top:5%" required>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center mt-4">
                                            <div class="col-2">
                                                <button type="button" class="btn btn-sm btn-dark"
                                                    data-bs-dismiss="modal">Fechar</button>
                                            </div>
                                            <div class="col-2">
                                                <button type="submit" class="btn btn-sm btn-success">Importar</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
