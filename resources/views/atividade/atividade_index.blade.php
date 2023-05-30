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
                <h3>Atividades</h3>
            </div>

            <div class="row d-flex align-items-center justify-content-end">
                <a class="criar-acao-button" href={{ route('atividade.create',['acao_id' => $acao->id])}}>
                    <img class="iconAdd" src="/images/acoes/listView/criar.svg" alt=""> Criar atividade
                </a>
            </div>

            <div class="row head-table d-flex align-items-center justify-content-center">
                <div class="col-4"><span class="spacing-col">Atividade/Função</span></div>
                <div class="col-4"><span>Data</span></div>
                <div class="col-4"><span>Participantes</span></div>
            </div>
        </div>

        <div class="list container overflow-scroll">
            @foreach ($atividades as $atividade)
                <div class="row linha-table d-flex align-items-center justify-content-center">
                    <div class="col-4"><span class="spacing-col">{{ $atividade->descricao }}</span></div>
                    <div class="col-4">
                        <span>{{ date('d-m-Y', strtotime($atividade->data_inicio)) . ' - ' . date('d-m-Y', strtotime($atividade->data_fim)) }}</span>
                    </div>
                    <div class="col-4 d-flex align-items-center justify-content-start">
                        <div class="col-3 d-flex align-items-center justify-content-center">
                            <a href="{{ route('participante.index', ['atividade_id' => $atividade->id]) }}">
                                <img src="/images/atividades/participantes.svg" alt="">
                            </a>
                        </div>
                        <div class="col-4">

                        </div>
                        <div class="col-5 d-flex align-items-center justify-content-evenly">
                            <a href="{{ route('atividade.delete', ['atividade_id' => $atividade->id]) }}">
                                <img src="/images/acoes/listView/lixoIcon.svg" alt="">
                            </a>
                            <a href="{{ route('atividade.edit', ['atividade_id' => $atividade->id]) }}">
                                <img src="/images/acoes/listView/editar.svg" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($acao->status == 'Aprovada')
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-md-2">
                        <a class="btn btn-success btn-sm"
                        style="margin-left:35%;"
                        href="{{route('certificados.download', ['acao_id' => $acao->id])}}">
                        Emtir certificados
                        </a> 
                    </div>
                </div>
            </div>
        @endif

    </section>
@endsection
