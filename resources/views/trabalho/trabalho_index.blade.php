@extends('layouts.app')

@section('title')
    Trabalhos
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/list.css">
@endsection

@section('content')
    <section class="view-list-acoes">

        <div class="container">

            <h1 class="text-center mb-4">Ação institucional: {{ $acao->titulo }}</h1>

            <h2 class="text-center mb-4">Atividade: {{ $atividade->descricao }} </h2>

            <div class="text-center mb-3">
                <h3>Trabalhos da Apresentação</h3>
            </div>


            <div class="row d-flex align-items-center justify-content-between">

                <div class="col-1">
                    <a type="button" class="button d-flex align-items-center justify-content-around between"
                       href="{{ route('atividade.index', ['acao_id' => $acao->id]) }}">
                        Voltar
                        <img src="/images/acoes/listView/voltar.svg" alt="">
                    </a>
                </div>

                <div class="col-8 text-end">
                    @if ($acao->status == null || $acao->status == 'Devolvida' || auth()->user()->perfil_id == 3)
                        <a class="criar-acao-button" href="{{ route('trabalho.create', ['atividade_id' => $atividade->id]) }}">
                            <img class="iconAdd" src="/images/acoes/listView/criar.svg" alt=""> Criar trabalho
                        </a>
                    @endif
                </div>
            </div>


            <div class="row head-table d-flex align-items-center justify-content-center">
                <div class="col-3"><span class="spacing-col">Título do Trabalho</span></div>
                <div class="col-2"><span>Carga Horária</span></div>
                <div class="col-5"><span>Autores/Coautores</span></div>
                <div class="col-2"><span>Funcionalidades</span></div>
            </div>
        </div>

        <div class="list container">
            @foreach ($trabalhos as $trabalho)
                <div class="row linha-table d-flex align-items-center justify-content-center">
                    <div class="col-3 text-truncate"><span class="spacing-col" title="{{ $trabalho->titulo }}">{{ $trabalho->titulo }}</span></div>
                    <div class="col-2">
                        <span>{{  $trabalho->carga_horaria }}</span>
                    </div>

                    <div class="col-5 titulo-span" title="{{ $trabalho->lista_nomes }}">
                        {{ $trabalho->nome_participantes }}
                    </div>



                    <div class="col-2 d-flex align-items-center justify-content-start">



                        <div class="col-8 d-flex align-items-center justify-content-around">


                            <a href="{{ route('autor.index', ['trabalho_id' => $trabalho->id]) }}"
                               title="Autores">
                                <img src="/images/atividades/participantes.svg" alt="">
                            </a>

                            @if ($acao->status == null || $acao->status == 'Devolvida' || auth()->user()->perfil_id == 3)
{{--                                <a href="/files/modelo.csv" title="Baixar Modelo">--}}
{{--                                    <img src="/images/acoes/listView/anexo.svg">--}}
{{--                                </a>--}}

                                <!--
                                <a href="" title="Importar Integrantes" data-bs-toggle="modal"
                                   data-bs-target="#modalImportCsv{{ $atividade->id }}">
                                   <img src="/images/acoes/listView/csvIcon.svg" alt="">
                                </a>
                                -->

                                <a href="{{ route('trabalho.edit', ['trabalho_id' => $trabalho->id]) }}" title="Editar">
                                    <img src="/images/acoes/listView/editar.svg" alt="">
                                </a>

                                <a onclick="return confirm('Você tem certeza que deseja remover o trabalho?')"
                                   href="{{ route('trabalho.delete', ['trabalho_id' => $trabalho->id]) }}" title="Excluir">
                                    <img src="/images/acoes/listView/lixoIcon.svg" alt="">
                                </a>
                            @endif
                        </div>

                        <div class="col-4"></div>
                    </div>
                </div>





                <!-- Modal -->
                    <!-- <div class="modal fade" id="modalImportCsv{{ $atividade->id }}" tabindex="-1"
                         aria-labelledby="modalImportCsvLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalImportCsvLabel">Importar CSV com os Dados dos Integrantes
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
                                                    <input type="file" accept=".csv" name="participantes_csv"
                                                           id="participantes_csv" class="form-control form-control-sm"
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
                    </div> -->
            @endforeach
        </div>
    </section>
@endsection
