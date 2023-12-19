@extends('layouts.app')

@section('title')
    Cadastrar Trabalho
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/create.css">
    <link rel="stylesheet" href="/css/cadastros/cadastrarAcao.css">
@endsection

@section('content')
    <section class="view-create-acao">

        <h1 class="text-center mb-4">Ação institucional: {{ $acao->titulo }}</h1>

        <h2 class="text-center mb-4">Atividade: {{ $atividade->descricao }} </h2>
        <h2 class="text-center mb-5">Cadastrar trabalho</h2>



        <form class="container form form-box " action="{{ Route('trabalho.store') }}" method="POST"
              enctype="multipart/form-data">
            @csrf

            <!--hiddens -->
            <input type="hidden" name="atividade_id" value="{{ $atividade->id }}">


            <div class="row box justify-content-center">

                <div class="row box">
                    <div
                        class="col-xl-8 campo input-create-box d-flex aligm-items-start justify-content-start flex-column">
                        <span class="tittle-input">Título<span class="ast">*</span></span>
                        <input class="w-100 h-100 input-text " type="text" name="titulo" id="" required>
                    </div>

                    <div
                        class="col-xl-4 campo spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                        <span class="tittle-input ">Carga Horária Total</span>
                        <input class="w-100 h-100 input-text" type="number" name="carga_horaria" id=""
                               pattern="[0-9]+" title="Digite um número válido" required>

                    </div>
                </div>






            </div>

            </br> </br>

            <div class="row d-flex justify-content-start align-items-center">
                <div class="col d-flex justify-content-evenly align-items-center input-create-box border-0">
                    <a class="button d-flex justify-content-center align-items-center cancel"
                       href="{{ route('trabalho.index', ['atividade_id' => $atividade->id]) }}"> Voltar</a>
                    <button class="button submit" type="submit">Cadastrar</button>
                </div>
            </div>

        </form>
    </section>

@endsection
