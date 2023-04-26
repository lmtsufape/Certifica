@extends('layouts.app')

@section('title')
    Editar Ação
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/create.css">
@endsection

@section('content')
    <div class='container'>
        <div class="row">
            @if ($errors->any())
                <dic class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </dic>
            @endif
        </div>
    </div>

    <h1 class="text-center">Editar ação</h1>
    <form class="container form" action="{{ Route('acao.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="usuario_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="unidade_administrativa_id" value="{{ Auth::user()->unidade_administrativa_id }}">

        <div class="row d-flex aligm-items-start justify-content-start ">
            <div class="col-5 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">Título</span><input value="{{ $acao->titulo }}" class="w-75 input-text "
                    type="text" name="titulo" id="">
            </div>
            <div class="col-3 spacing-row1 input-create-box">
                <span class="tittle-input w-50">Data de inicio</span><input value="{{ $acao->data_inicio }}" class="w-75"
                    type="date" name="data_inicio" id="">
            </div>
            <div class="col-3 input-create-box">
                <span class="tittle-input w-50">Data de fim</span><input value="{{ $acao->data_fim }}" class="w-75"
                    type="date" name="data_fim" id="">
            </div>
        </div>

        <div class="row d-flex justify-content-start align-items-start">
            <div class="spacing-row2 col-4 input-create-box d-flex aligm-items-start justify-content-start flex-column">
                <span class="tittle-input w-25">Natureza</span>

                <select name="natureza_id" class="select-form w-75 ">

                    <option value=" {{ $acao->natureza_id }}" selected hidden>{{ $natureza->descricao }}</option>
                    @foreach ($naturezas as $natureza)
                        <option value="{{ $natureza->id }}">{{ $natureza->descricao }}</option>
                    @endforeach

                </select>

            </div>
            <div class="col-2 input-create-box input-create-box d-flex aligm-items-start justify-content-start flex-column">
                <span class="tittle-input n-edital">Nº edital</span><input class="w-50 input-text" type="text"
                    name="" id="">
            </div>
            <div class="col-5 input-create-box border-0 d-flex flex-column justify-content-between">
                <input type="file" name="anexo" id="anexo" placeholder="a">
                <label class="label-file input-create-box d-flex aligm-items-start justify-content-center" for="anexo"
                    id="">arquivo.pdf(estatic)</label>

            </div>
        </div>

        <div class="row d-flex justify-content-start align-items-center">
            <div class="boxicon col-11 d-flex align-items-center justify-content-end ">

                <label for="anexo" id=""><img src="/images/acoes/create/upload.svg" alt=""></label>

            </div>
        </div>

        <div class="row d-flex justify-content-start align-items-center">
            <div class="col d-flex justify-content-evenly align-items-center input-create-box border-0">
                <a class="d-flex justify-content-center align-items-center cancel" href={{ route('home') }}>Cancelar</a>
                <button class="submit" type="submit">Atualizar</button>
            </div>
        </div>

    </form>


@endsection
