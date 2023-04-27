@extends('layouts.app')

@section('title')
    Cadastrar Atividades
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/create.css">
@endsection

@section('content')
    <div class="container">

        @if ($errors->any())
            )
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif
    </div>

    <h1 class="text-center">Cadastrar atividade</h1>
    <form class="container form" action="{{ Route('atividade.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="acao_id" value="{{ $acao->id }}">

        <div class="row d-flex aligm-items-start justify-content-start ">

            <div class="col-7 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input">Atividade</span>
                <select class="select-form w-75 " name="descricao" id="">
                    <option value="" selected hidden>Escolher...</option>
                    @foreach ($descricoes as $descricao)
                        <option value="{{ $descricao }}">{{ $descricao }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-4 spacing-row1 input-create-box">
                <span class="tittle-input w-50">Data de inicio</span>
                <input class="w-75" type="date" name="data_inicio" id="">
            </div>

        </div>

        <div class="row d-flex aligm-items-start justify-content-start">

            <div class="col-7 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input">Ação</span>
                <input value="{{$acao->titulo}}" class="w-75 input-text" type="text" name="titulo" id="" disabled>
            </div>

            <div class="col-4 input-create-box">
                <span class="tittle-input w-50">Data de fim</span>
                <input class="w-75" type="date" name="data_fim" id="">
            </div>

        </div>

        <div class="row d-flex justify-content-start align-items-center">
            <div class="col d-flex justify-content-evenly align-items-center input-create-box border-0">
                <a class="d-flex justify-content-center align-items-center cancel" href={{ Route('atividade.index',['acao_id' => $acao->id, ])}}> Cancelar</a>
                <button class="submit" type="submit">Cadastrar</button>
            </div>
        </div>

    </form>
@endsection
