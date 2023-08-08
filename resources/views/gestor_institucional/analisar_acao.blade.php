@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/acoes/list.css">
@endsection

@section('content')
    <div class='container'>
        <section class="view-list-acoes">

            <h1 class="text-center mb-4">Ação institucional: {{ $acao->titulo }}</h1>
            @if ($acao->anexo != null)
                <h6 class=" mb-5">Clique <a href="{{ route('anexo.download', ['acao_id' => $acao->id]) }}">aqui</a>
                    para obter o anexo da ação
                </h6>
            @endif

            <div class="container">

                <div class="text-center mb-3">
                    <h3>Atividades</h3>
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

                                <a href="{{ route('participante.index', ['atividade_id' => $atividade->id]) }}">
                                    <img src="/images/atividades/participantes.svg" alt="" title="Integrantes">
                                </a>

                                <a href="{{ route('atividade.edit', ['atividade_id' => $atividade->id]) }}">
                                    <img src="/images/acoes/listView/editar.svg" alt="" title="Editar">
                                </a>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </section>
    </div>
@endsection
