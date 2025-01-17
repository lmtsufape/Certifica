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
                            <a class="criar-acao-button" href="{{ route('atividade.create', ['acao_id' => $acao->id]) }}">
                                <img class="iconAdd" src="/images/acoes/listView/criar.svg" alt=""> Criar atividade
                            </a>
                        @endif
                    </div>

                </div>

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
