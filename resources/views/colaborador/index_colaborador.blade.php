@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/acoes/list.css">
@endsection

@section('content')
    <section class="view-list-acoes">
        <h1 class="text-center mb-4">Listar Colaborações</h1>

        <div class="container">
            <div class="row d-flex align-items-center justify-content-between">
            
                <div class="col-1">
                    <a type="button" class="button d-flex align-items-center justify-content-around between"
                        href="{{ route('home') }}">
                        Voltar
                        <img src="/images/acoes/listView/voltar.svg" alt="">
                    </a>
                </div>
            </div>
        </div>
                <!-- Cabeçalho -->
                <div class="container">
            <div class="row head-table d-flex align-items-center justify-content-start">
                <div class="col-5 text-start"><span class="spacing-col">Título</span></div>
                <div class="col-1 text-center"><span>Natureza</span></div>
                <div class="col-2 text-center"><span>Tipo Natureza</span></div>
                <div class="col-1 text-center"><span>Status</span></div>
                <div class="col-1 text-center"><span>Gestor</span></div>
                <div class="col-2 text-center"><span>Funcionalidades</span></div>
            </div>
        </div>
        <div class="list container">
            @foreach ($colaboracoes as $colaboracao)
                <div class="row linha-table d-flex align-items-center justify-content-start">
                    <div title="{{ $colaboracao->acao->titulo }}" class="col-5 titulo-span text-start"><span
                            class="spacing-col">{{ $colaboracao->acao->titulo }}</span></div>
                    <div class="col-1 text-center"><span>{{ $colaboracao->acao->tipo_natureza->natureza->descricao }}</span></div>
                    <div title="{{ $colaboracao->acao->tipo_natureza->descricao }}" class="col-2 text-center titulo-span">
                        <span>{{ $colaboracao->acao->tipo_natureza->descricao }}</span>
                    </div>
                    <div class="col-1 text-center tag tag-{{ $colaboracao->acao->status }}">
                        <span>{{ $colaboracao->acao->status }}</span>
                    </div>
                    <div class="col-1 text-center"><span>{{ $colaboracao->acao->user->name }}</span></div>
                    <div class="col-2 d-flex align-items-center justify-content-evenly">
                    <span><a href="{{ route('atividade.index', ['acao_id' => $colaboracao->acao->id]) }}"><img
    src="/images/acoes/listView/atividade.svg" alt="Atividades" title="Atividades"></a></span>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
