@extends('layouts.app')

@section('title')
    Editar Participante
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/create.css">
    <link rel="stylesheet" href="/css/cadastros/cadastrarAcao.css">
@endsection

@section('content')
    <section class="create-acao-view">

        <h1 class="text-center mb-4">Ação Institucional: {{ $acao->titulo }}</h1>
        <h1 class="text-center mb-5">Editar Atividade / Função</h1>

        <form class="container form form-box" action="{{ Route('atividade.update') }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <!--hiddens -->
            <input type="hidden" name="id" value="{{ $atividade->id }}">
            <input type="hidden" name="acao_id" value="{{ $acao->id }}">
            <input value="{{ $acao->titulo }}" hidden class="w-75 input-text" type="text" name="titulo" id="">


            <div class="row box">

                <div
                    class="col-xl-4 campo spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                    <span class="tittle-input">Atividade/Função</span>
                    <select class="select-form w-100 h-100 " name="descricao" id="">
                        <option value={{ $atividade->descricao }} selected hidden>{{ $atividade->descricao }}</option>
                        @foreach ($descricoes as $descricao)
                            <option value="{{ $descricao }}">{{ $descricao }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-xl-3 campo spacing-row1 input-create-box">
                    <span class="tittle-input w-50">Data de Início</span>
                    <input class="w-100 h-75" type="date" name="data_inicio" id=""
                        value="{{ $atividade->data_inicio }}">
                </div>
                <div class="col-xl-3 campo input-create-box">
                    <span class="tittle-input w-50">Data de Término</span>
                    <input class="w-100 h-75" type="date" name="data_fim" id=""
                        value="{{ $atividade->data_fim }}">
                </div>

            </div>

            <div class="row d-flex justify-content-start align-items-center">
                <div class="col d-flex justify-content-evenly align-items-center input-create-box border-0">
                    <a class="button mt-4 d-flex justify-content-center align-items-center cancel"
                        href="{{ Route('atividade.index', ['acao_id' => $acao->id]) }}"> Voltar</a>
                    <button class="button mt-4 submit" type="submit">Editar</button>
                </div>
            </div>

        </form>
    </section>
@endsection
