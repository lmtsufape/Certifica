@extends('layouts.app')

@section('title')
    Editar Participante
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/create.css">
@endsection

@section('content')
    <h1 class="text-center mb-4">Ação Institucional: {{ $acao->titulo }}</h1>
    <h1 class="text-center">Editar Atividade/Função</h1>

    <form class="container form" action="{{Route('atividade.update')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <!--hiddens -->
        <input type="hidden" name="id" value="{{ $atividade->id }}">
        <input type="hidden" name="acao_id" value="{{ $acao->id }}">
        <input value="{{ $acao->titulo }}" hidden class="w-75 input-text" type="text" name="titulo" id="">


        <div class="row d-flex aligm-items-start justify-content-start ">

            <div class="col-4 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column mb-5">
                <span class="tittle-input">Atividade/Função</span>
                <select class="select-form w-100 " name="descricao" id="">
                    <option value={{$atividade->descricao}} selected hidden>{{$atividade->descricao}}</option>
                    @foreach ($descricoes as $descricao)
                        <option value="{{ $descricao }}">{{ $descricao }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-3 spacing-row1 input-create-box">
                <span class="tittle-input w-50">Data de Início</span>
                <input class="w-100" type="date" name="data_inicio" id="" value="{{$atividade->data_inicio}}">
            </div>
            <div class="col-3 input-create-box">
                <span class="tittle-input w-50">Data de Término</span>
                <input class="w-100" type="date" name="data_fim" id="" value="{{$atividade->data_fim}}">
            </div>

        </div>

        <div class="row d-flex justify-content-start align-items-center">
            <div class="col d-flex justify-content-evenly align-items-center input-create-box border-0">
                <a class="d-flex justify-content-center align-items-center cancel"
                   href={{ Route('atividade.index', ['acao_id' => $acao->id]) }}> Cancelar</a>
                <button class="submit" type="submit">Atualizar</button>
            </div>
        </div>

    </form>

@endsection
