@extends('layouts.app')

@section('title')
    Cadastrar Atividades
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/create.css">
    <link rel="stylesheet" href="/css/cadastros/cadastrarAcao.css">
@endsection

@section('content')
    <section class="view-create-acao"> 


        <h1 class="text-center mb-4">Ação institucional: {{ $acao->titulo }}</h1>
        <h2 class="text-center mb-5">Cadastrar atividade / função</h2>

        <form class="container form form-box " action="{{ Route('atividade.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <!--hiddens -->
            <input type="hidden" name="acao_id" value="{{ $acao->id }}">
            <input value="{{ $acao->titulo }}" hidden class="w-75 input-text" type="text" name="titulo"id="">


            <div class="row box justify-content-center">

                <div
                    class="col-xl-4 border campo spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                    <span class="tittle-input">Atividade / Função</span>
                    <select class="select-form w-100 h-100 " name="descricao" id="select_atividade">
                        <option value="" selected hidden>Escolher...</option>
                        @foreach ($descricoes as $descricao)
                            <option value="{{ $descricao }}">{{ $descricao }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-xl-3 campo spacing-row1 input-create-box" id="outra_atividade" style="display: none;">
                    <div class="col-xl-12 campo d-flex aligm-items-start justify-content-start flex-column">
                        <span class="tittle-input">Atividade / Função<span class="ast">*</span></span>
                        <input class="w-100 h-100 input-text " type="text" name="outra" id="">
                    </div>
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

            </br> </br>

            <div class="row d-flex justify-content-start align-items-center">
                <div class="col d-flex justify-content-evenly align-items-center input-create-box border-0">
                    <a class="button d-flex justify-content-center align-items-center cancel"
                        href="{{ Route('atividade.index', ['acao_id' => $acao->id]) }}"> Voltar</a>
                    <button class="button submit" type="submit">Cadastrar</button>
                </div>
            </div>

        </form>
    </section>
    <script>
        const select_atividade = document.getElementById("select_atividade");
        const outra_atividade = document.getElementById("outra_atividade");

        $("#select_atividade").change(function() {
            if (select_atividade.value === "Outra") {
                outra_atividade.style.display = "block";
            } else {
                outra_atividade.style.display = "none";
            }
        });
    </script>
@endsection
