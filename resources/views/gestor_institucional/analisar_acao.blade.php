@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/acoes/list.css">
@endsection

@section('content')
    <div class='container'>
        <section class="view-list-acoes">

            <h1 class="text-center mb-4">Ação institucional:
                @if ($acao->anexo != null)
                    <a href="{{ route('anexo.download', ['acao_id' => $acao->id]) }}">anexo</a>
                @endif
            </h1>



            <div class="container">

                <div class="text-center mb-3">
                    <h3>Atividades / {{ $acao->titulo }}</h3>
                </div>

                <div class="row d-flex align-items-center justify-content-between">
                    <div class="col-1">
                        <a type="button" class="button d-flex align-items-center justify-content-around between"
                           href="{{ route('gestor.acoes_submetidas') }}">
                            Voltar
                            <img src="/images/acoes/listView/voltar.svg" alt="">
                        </a>
                    </div>

                    <div class="col-8 text-end">
                        @if ($acao->status == 'Em análise')
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
                                <label for="descricao" class="form-label">Atividade / Função<span class="ast" style="color: red;">*</span></label>
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
                                <label for="data_inicio" class="form-label">Data de Início<span class="ast" style="color: red;">*</span></label>
                                <input type="date" class="form-control" name="data_inicio">
                            </div>
                            <div class="col">
                                <label for="data_fim" class="form-label">Data de Término<span class="ast" style="color: red;">*</span></label>
                                <input type="date" class="form-control" name="data_fim">
                            </div>
                        </div>
                    </form>
                </x-modal-component>

                <script>
                    document.getElementById('submitFormButton').addEventListener('click', function () {
                        document.getElementById('atividadeForm').submit();  // Envia o formulário quando "Cadastrar" for clicado
                    });
                </script>

                <div class="row head-table d-flex align-items-center justify-content-center">
                    <div class="col-4"><span class="spacing-col">Descrição</span></div>
                    <div class="col-3"><span>Início</span></div>
                    <div class="col-3"><span>Fim</span></div>
                    <div class="col-2"><span>Funcionalidades</span></div>
                </div>
            </div>

            <div class="list container">
                @foreach ($atividades as $atividade)
                    <div class="row linha-table d-flex align-items-center justify-content-start">
                        <div class="col-4"><span class="spacing-col">{{ $atividade->descricao }}</span></div>
                        <div class="col-3"><span>
                                {{ collect(explode('-', $atividade->data_inicio))->reverse()->join('/') }}</span></div>
                        <div class="col-3">
                            <span>
                                {{ collect(explode('-', $atividade->data_fim))->reverse()->join('/') }}
                            </span>
                        </div>
                        <div class="col-2 ">

                            <div class="col-1"></div>
                            <div class="col-9 d-flex align-items-center justify-content-evenly">

                                <a href="{{ route('participante.index', ['atividade_id' => $atividade->id, 'solicitacao' => true]) }}">
                                    <img src="/images/atividades/participantes.svg" alt="" title="Integrantes">
                                </a>

                                <a href="{{ route('atividade.edit', ['atividade_id' => $atividade->id]) }}">
                                    <img src="/images/acoes/listView/editar.svg" alt="" title="Editar">
                                </a>

                                <a onclick="return confirm('Você tem certeza que deseja excluir esta atividade?')" href="{{ route('atividade.delete', ['atividade_id' => $atividade->id]) }}">
                                    <img src="/images/acoes/listView/lixoIcon.svg" alt="" title="Deletar">
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </section>
    </div>
@endsection
