@extends('layouts.app')

@section('title')
    Cadastrar Atividades
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/create.css">
    <link rel="stylesheet" href="/css/cadastros/cadastrarAcao.css">
@endsection

@section('content')
    <h1 class="text-center mb-4">Ação Institucional: {{ $acao->titulo }}</h1>
    <h2 class="text-center mb-5">Cadastrar Atividade/Função</h2>

    <form class="container form form-box " action="{{ Route('atividade.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!--hiddens -->
        <input type="hidden" name="acao_id" value="{{ $acao->id }}">
        <input value="{{ $acao->titulo }}" hidden class="w-75 input-text" type="text" name="titulo"id="">


        <div class="row box ">

            <div class="col-xl-4 border campo spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input">Atividade/Função</span>
                <select class="select-form w-100 h-100 " name="descricao" id="">
                    <option value="" selected hidden>Escolher...</option>
                    @foreach ($descricoes as $descricao)
                        <option value="{{ $descricao }}">{{ $descricao }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-xl-3 campo spacing-row1 input-create-box">
                <span class="tittle-input w-50">Data de Início</span>
                <input class="w-100 h-75" type="date" name="data_inicio" id="">
            </div>
            <div class="col-xl-3 campo input-create-box">
                <span class="tittle-input w-50">Data de Término</span>
                <input class="w-100 h-75" type="date" name="data_fim" id="">
            </div>
        </div>


        <div class="row d-flex justify-content-start align-items-center">
            <div class="col d-flex justify-content-evenly align-items-center input-create-box border-0">
                <a class="d-flex justify-content-center align-items-center cancel"
                    href={{ Route('atividade.index', ['acao_id' => $acao->id]) }}> Cancelar</a>
                <button class="submit" type="submit">Cadastrar</button>
            </div>
        </div>

    </form>
@endsection
