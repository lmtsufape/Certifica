@extends('layouts.app')

@section('title')
    Atividades
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/list.css">
@endsection

@section('content')
    <section class="view-list-acoes">

        <div class="container">

            <h1 class="text-center mb-4">Ação Institucional: {{ $acao->titulo }}</h1>

            <div class="text-center mb-3">
                <h3>Atividades / Funções</h3>
            </div>

            <a style="position:absolute" type="button" class="btn btn-sm btn-outline-dark" href="{{route('acao.index')}}">Voltar</a>

            <div class="row d-flex align-items-center justify-content-end">
                <a class="criar-acao-button" href="{{ route('atividade.create', ['acao_id' => $acao->id]) }}">
                    <img class="iconAdd" src="/images/acoes/listView/criar.svg" alt=""> Criar atividade
                </a>
            </div>

            <div class="row head-table d-flex align-items-center justify-content-center">
                <div class="col-2"><span class="spacing-col">Atividade / Função</span></div>
                <div class="col-2"><span>Período</span></div>
                <div class="col-5"><span>Integrantes</span></div>
                <div class="col-3"><span>Funcionalidades</span></div>
            </div>
        </div>

        <div class="list container overflow-scroll">
            @foreach ($atividades as $atividade)
                <div class="row linha-table d-flex align-items-center justify-content-center">
                    <div class="col-2"><span class="spacing-col">{{ $atividade->descricao }}</span></div>
                    <div class="col-2">
                        <span>{{ collect(explode('-', $atividade->data_inicio))->reverse()->join('/') .
                            ' - ' .
                            collect(explode('-', $atividade->data_fim))->reverse()->join('/') }}</span>
                    </div>

                    <div class="col-5 titulo-span" title="{{$atividade->nome_participantes}}">
                        {{$atividade->nome_participantes}}
                    </div>

                    

                    <div class="col-3 d-flex align-items-center justify-content-start">

                                        
                        <div class="col-5 d-flex align-items-center justify-content-evenly">
                            <a href="{{ route('participante.index', ['atividade_id' => $atividade->id]) }}" title="Integrantes">
                                <img src="/images/atividades/participantes.svg" alt="">
                            </a>

                            @if ($acao->status == null)
                                <a href="/files/modelo.csv" title="Baixar Modelo">
                                    <img src="/images/acoes/listView/anexo.svg">
                                </a>

                                <a href="" title="Importar Integrantes" data-bs-toggle="modal" data-bs-target="#modalImportCsv{{$atividade->id}}">
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
                        </div>

                        <div class="col-7">

                        </div>
                    </div>
                </div>





                <!-- Modal -->
                <div class="modal fade" id="modalImportCsv{{$atividade->id}}" tabindex="-1" aria-labelledby="modalImportCsvLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalImportCsvLabel">Importar CSV com os Dados dos Integrantes</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>


                            <div class="modal-body">
                                <div class="container">
                                    <form class="form"
                                        action="{{ Route('import_participantes', ['atividade_id' => $atividade->id]) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row align-items-start">
                                            <div>
                                                <input type="file" accept=".csv" name="participantes_csv" id="participantes_csv"
                                                    class="form-control form-control-sm" style="margin-top:5%" required>
                                            </div>

                                            <div class="row justify-content-center">
                                                <div class="col-5" style="margin-left:10%; margin-top:25px;">
                                                    <button type="button" class="btn btn-sm btn-secondary"
                                                    data-bs-dismiss="modal">Fechar</button>
                                                    <button type="submit" class="btn btn-sm btn-success">Importar</button>
                                                </div>
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
