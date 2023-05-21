@extends('layouts.app')

@section('title')
    Editar Ação
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/create.css">
@endsection

@section('content')
    <h1 class="text-center">Editar ação</h1>
    <form class="container form" action="{{ route('acao.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Hiddens-->
        <input type="hidden" name="id" value="{{ $acao->id }}">
        <input type="hidden" name="usuario_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="unidade_administrativa_id" value="{{ Auth::user()->unidade_administrativa_id }}">


        <div class="form-row">

            <div class="row d-flex aligm-items-start justify-content-start">
                <div class="col-md-12 input-create-box d-flex aligm-items-start justify-content-start flex-column">
                    <span class="tittle-input">Título<strong style="color: red">*</strong></span>
                    <input class="w-75 input-text " type="text" name="titulo" id="" value="{{ $acao->titulo }}"
                        required>
                </div>
            </div>

            <div class="row d-flex aligm-items-start justify-content-start">
                <input hidden type="file" name="anexo" id="anexo">

                <div
                    class="col-md-5 spacing-row2 input-create-box border-upload d-flex align-items-start justify-content-start flex-column">
                    <span class="tittle-input">Arquivo<strong style="color: red">*</strong></span>

                    <div class="w-100 d-flex align-items-center justify-content-between">
                        <input class="w-75 input-text " type="text" name="" id="arquivo" disabled value=""
                            placeholder="Insira aqui o seu arquivo" required>
                        <label for="anexo" id="">
                            <img class="upload-icon tittle-input" src="/images/acoes/create/upload.svg" alt="">
                            <label for="anexo" id=""> </label>
                    </div>

                </div>

                <div class="col-md-3 spacing-row2 input-create-box ">
                    <span class="tittle-input">Início<strong style="color: red">*</strong></span><input class="w-100"
                        type="date" name="data_inicio" id="" value="{{ $acao->data_inicio }}" required>
                </div>

                <div class="col-md-3 input-create-box">
                    <span class="tittle-input">Término<strong style="color: red">*</strong></span><input class="w-100"
                        type="date" name="data_fim" id="" value="{{ $acao->data_fim }}" required>
                </div>
            </div>


            <div class="row d-flex aligm-items-start justify-content-start">
                <div
                    class="col-md-4 spacing-row2 input-create-box border-upload d-flex align-items-start justify-content-start flex-column">
                    <span class="tittle-input">Natureza<strong style="color: red">*</strong></span>
                    <select class="select-form w-100 " name="natureza_id" id="select_natureza" required>
                        <option id="NaturezaSelecionada" value={{ $natureza->id }} selected> {{ $natureza->descricao }}
                        </option>
                        @foreach ($naturezas as $natureza)
                            <option value="{{ $natureza->id }}">{{ $natureza->descricao }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-7 input-create-box d-flex aligm-items-start justify-content-start flex-column">
                    <span class="tittle-input">Tipo<strong style="color: red">*</strong></span>

                    <input type="hidden" name="tipo_natureza_id" value="0">

                    <select name="ensino" class="select-form w-100 " id="select_tipo_natureza_ensino">
                        <option id="tipoNaturezaSelecionado" value={{ $tipo_natureza->id }} selected>
                            {{ $tipo_natureza->descricao }}</option>
                        @foreach ($naturezas_ensino as $natureza_ensino)
                            <option value="{{ $natureza_ensino->id }}">{{ $natureza_ensino->descricao }}</option>
                        @endforeach
                    </select>

                    <select name="extensao" class="select-form w-100 " id="select_tipo_natureza_extensao">
                        <option id="tipoNaturezaSelecionado" value={{ $tipo_natureza->id }} selected>
                            {{ $tipo_natureza->descricao }}</option>
                        @foreach ($naturezas_extensao as $natureza_extensao)
                            <option value="{{ $natureza_extensao->id }}">{{ $natureza_extensao->descricao }}</option>
                        @endforeach
                    </select>

                    <select name="pesquisa" class="select-form w-100 " id="select_tipo_natureza_pesquisa">
                        <option id="tipoNaturezaSelecionado" value={{ $tipo_natureza->id }} selected>
                            {{ $tipo_natureza->descricao }}</option>

                        @foreach ($naturezas_pesquisa as $natureza_pesquisa)
                            <option value="{{ $natureza_pesquisa->id }}">{{ $natureza_pesquisa->descricao }}</option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="row d-flex justify-content-start align-items-center">
                <div class="col d-flex justify-content-evenly align-items-center input-create-box border-0">
                    <a class="d-flex justify-content-center align-items-center cancel"
                        href={{ route('home') }}>Cancelar</a>
                    <button class="submit" type="submit">Cadastrar</button>
                </div>
            </div>

    </form>

    <script>
        var campoanexo = document.getElementById('anexo');
        var campoArquivo = document.getElementById('arquivo');

        campoanexo.addEventListener('change', (e) => {

            var string = e.target.value

            var dados = string.split(/[\\"]/g)

            campoArquivo.value = dados[dados.length - 1]

        })

        var NaturezaSelecionada = document.getElementById('NaturezaSelecionada');
        var tipoNaturezaSelecionada = document.querySelectorAll('#tipoNaturezaSelecionado')
        var SelectNatureza = document.getElementById('select_natureza')

        SelectNatureza.addEventListener('change', (e) => {

            if (e.target.value == 1) {
                tipoNaturezaSelecionada.forEach(element => {
                    element.innerText = "-- Tipo Natureza --"
                });
            } else if (e.target.value == 2) {
                tipoNaturezaSelecionada.forEach(element => {
                    element.innerText = "-- Tipo Natureza --"
                });

            } else if (e.target.value == 3) {
                tipoNaturezaSelecionada.forEach(element => {
                    element.innerText = "-- Tipo Natureza --"
                });
            }

        })

        if (NaturezaSelecionada.value == 1) {
            //ensino
            $("#select_tipo_natureza_extensao").hide();
            $("#select_tipo_natureza_pesquisa").hide();
        } else if (NaturezaSelecionada.value == 2) {
            //extensao
            $("#select_tipo_natureza_pesquisa").hide();
            $("#select_tipo_natureza_ensino").hide();
        } else if (NaturezaSelecionada.value == 3) {
            //pesquisa
            $("#select_tipo_natureza_ensino").hide();
            $("#select_tipo_natureza_extensao").hide();
        }


        $("#select_natureza").change(function() {
            if ($("#select_natureza").val() == 1) {
                $("#select_tipo_natureza_ensino").show();
                $("#select_tipo_natureza_extensao").hide();
                $("#select_tipo_natureza_pesquisa").hide();

            } else if ($("#select_natureza").val() == 2) {
                $("#select_tipo_natureza_ensino").hide();
                $("#select_tipo_natureza_extensao").show();
                $("#select_tipo_natureza_pesquisa").hide();

            } else if ($("#select_natureza").val() == 3) {
                $("#select_tipo_natureza_ensino").hide();
                $("#select_tipo_natureza_extensao").hide();
                $("#select_tipo_natureza_pesquisa").show();

            }
        });
    </script>

@endsection



<!--
    <h1 class="text-center">Editar ação</h1>
    <form class="container form" action="{{ route('acao.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="id" value="{{ $acao->id }}">
        <input type="hidden" name="usuario_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="unidade_administrativa_id" value="{{ Auth::user()->unidade_administrativa_id }}">

        <div class="row d-flex aligm-items-start justify-content-start ">
            <div class="col-md-5 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">Título</span><input value="{{ $acao->titulo }}" class="w-75 input-text "
                    type="text" name="titulo" id="">
            </div>
            <div class="col-md-3 spacing-row1 input-create-box">
                <span class="tittle-input w-100">Data de início</span><input value="{{ $acao->data_inicio }}" class="w-100"
                    type="date" name="data_inicio" id="">
            </div>
            <div class="col-md-3 input-create-box">
                <span class="tittle-input w-100">Data de fim</span><input value="{{ $acao->data_fim }}" class="w-100"
                    type="date" name="data_fim" id="">
            </div>
        </div>



         <div class="row d-flex aligm-items-start justify-content-start">

            <div class="spacing-row1 col-md-5 input-create-box d-flex aligm-items-start justify-content-start flex-column">
                <span class="tittle-input w-25">Natureza</span>
                <select class="select-form w-100 " name="natureza_id" id="">
                    <option value="{{ $natureza->descricao }}">{{ $natureza->descricao }}</option>
                    @foreach ($naturezas as $natureza)
<option value="{{ $natureza->id }}">{{ $natureza->descricao }}</option>
@endforeach
                </select>
            </div>

            <div
                class="col-md-3 spacing-row1 input-create-box input-create-box d-flex aligm-items-start justify-content-start flex-column">
                <span class="tittle-input n-edital">Nº edital</span><input class="w-50 input-text" type="text"
                    name="" id="">
            </div>

            <input hidden type="file" name="anexo" id="anexo" placeholder="a">

            <div class="col-md-3 label-file border input-create-box d-flex align-items-center justify-content-center">

                <label class="w-100 d-flex align-items-center justify-content-beetwen" for="anexo" id="">
                    <span class="Nome-arquivo">arquivo.pdf(estatic)</span>
                    <img class="upload-icon" src="/images/acoes/create/upload.svg" alt="">
                </label>

            </div>
        </div>

        <div class="row d-flex justify-content-start align-items-center">
            <div class="col d-flex justify-content-evenly align-items-center input-create-box border-0">
                <a class="d-flex justify-content-center align-items-center cancel" href={{ route('home') }}>Cancelar</a>
                <button class="submit" type="submit">Cadastrar</button>
            </div>
        </div>

    </form>
-->
