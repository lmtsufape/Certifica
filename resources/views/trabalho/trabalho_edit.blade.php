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

        <h1 class="text-center mb-4">Ação institucional: {{ $acao->titulo }}</h1>
        <h1 class="text-center mb-4">Atividade / função: {{ $atividade->descricao }}</h1>
        <h1 class="text-center mb-5">Editar Trabalho</h1>

        <form class="container form form-box" action="{{ Route('trabalho.update') }}" method="POST"
              enctype="multipart/form-data">
            @csrf

            <!--hiddens -->
            <input type="hidden" name="id" value="{{ $trabalho->id }}">
            <input type="hidden" name="atividade_id" value="{{ $atividade->id }}">
            <input value="{{ $acao->titulo }}" hidden class="w-75 input-text" type="text" name="titulo" id="">


            <div class="row box">



                <div class="col-xl-8 campo input-create-box d-flex aligm-items-start justify-content-start flex-column">
                    <span class="tittle-input w-50">Título</span>
                    <input class="w-100 h-100 input-text " type="text" name="titulo" id=""
                           value="{{ $trabalho->titulo }}" >
                </div>
                <div
                    class="col-xl-4 campo spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                    <span class="tittle-input ">Carga Horária Total</span>
                    <input class="w-100 h-100 input-text " type="text" name="carga_horaria" id=""
                           value="{{ $trabalho->carga_horaria }}" pattern="[0-9]+" title="Digite um número válido"
                           required>
                </div>

            </div>

            <div class="row d-flex justify-content-start align-items-center">
                <div class="col d-flex justify-content-evenly align-items-center input-create-box border-0">
                    <a class="button mt-4 d-flex justify-content-center align-items-center cancel"
                       href="{{ Route('trabalho.index', ['atividade_id' => $atividade->id]) }}"> Voltar</a>
                    <button class="button mt-4 submit" type="submit">Salvar</button>
                </div>
            </div>

        </form>
    </section>
@endsection
