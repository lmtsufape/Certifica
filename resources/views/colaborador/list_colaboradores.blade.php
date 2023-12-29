@extends('layouts.app')

@section('title')
    Colaboradores da Ação {{ $acao->titulo }}
@endsection

@section('content')
    <h1 class="text-center mb-4">Colaboradores da Ação: {{ $acao->titulo }}</h1>

    <div class="text-center mb-3">
        <h3>Colaboradores</h3>
    </div>

    <div class="row d-flex align-items-center justify-content-between">

        <div class="col-1">
            <a type="button" class="button d-flex align-items-center justify-content-around between"
                href="{{ route('gestor.analisar_acao', ['acao_id' => $acao->id]) }}">
                Voltar
                <img src="/images/acoes/listView/voltar.svg" alt="">
            </a>
        </div>

    </div>

    <div class="row head-table d-flex align-items-center justify-content-center">
        <div class="col-3"><span>Nome</span></div>
        <div class="col-2"><span>CPF/ Passaporte</span></div>
        <div class="col-2"><span>Email</span></div>
        <div class="col-2"><span>Funcionalidades</span></div>
    </div>


@endsection