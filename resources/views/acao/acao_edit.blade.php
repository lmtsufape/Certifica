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

                <input hidden type="file" name="anexo" id="anexo" value={{$acao->anexo}}>

                <div
                    class="col-md-5 spacing-row2 input-create-box border-upload d-flex align-items-start justify-content-start flex-column">
                    <span class="tittle-input">Processo SIPAC, relatório final ou similares<strong style="color: red">*</strong></span>

                    <div class="w-100 d-flex align-items-center justify-content-between">
                        <input class="w-75 input-text " type="text" name="" id="arquivo" disabled value=""
                            placeholder="Insira aqui o seu arquivo" required>
                        <label for="anexo" id="">
                            <img class="upload-icon tittle-input" src="/images/acoes/create/upload.svg" alt="">
                            <label for="anexo" id=""> </label>
                    </div>

                </div>

                <div class="col-md-3 spacing-row2 input-create-box ">
                    <span class="tittle-input">Data de Início<strong style="color: red">*</strong></span><input class="w-100"
                        type="date" name="data_inicio" id="" value="{{ $acao->data_inicio }}" required>
                </div>

                <div class="col-md-3 input-create-box">
                    <span class="tittle-input">Data de Término<strong style="color: red">*</strong></span><input class="w-100"
                        type="date" name="data_fim" id="" value="{{ $acao->data_fim }}" required>
                </div>
            </div>


            <div class="row d-flex aligm-items-start justify-content-start">

                @if(Auth::user()->perfil_id == 3)
                    <input type="hidden" name="natureza_id" value="{{ $natureza->id }}">

                    <div
                        class="col-md-4 spacing-row2 input-create-box border-upload d-flex align-items-start justify-content-start flex-column">
                        <span class="tittle-input">Natureza<strong style="color: red">*</strong></span>
                        <input class="w-75 input-text" value="{{ $natureza->descricao }}" disabled>
                    </div>

                    <div class="col-md-7 input-create-box d-flex aligm-items-start justify-content-start flex-column">
                        <span class="tittle-input">Tipo<strong style="color: red">*</strong></span>

                        <select name="tipo_natureza_id" class="select-form w-100 " id="select_tipo_natureza" required>
                            <option value="{{ $tipo_natureza->id }}" selected hidden>{{ $tipo_natureza->descricao }}</option>
                            @foreach ($tipo_naturezas as $tipo_natureza)
                                <option value="{{ $tipo_natureza->id }}">{{ $tipo_natureza->descricao }}</option>
                            @endforeach
                        </select>
                    </div>
                @else
                    <div
                        class="col-md-4 spacing-row2 input-create-box border-upload d-flex align-items-start justify-content-start flex-column">
                        <span class="tittle-input">Natureza<strong style="color: red">*</strong></span>
                        <select class="select-form w-100 " name="natureza_id" id="select_natureza" required>
                            <option value="{{ $natureza->id }}" selected hidden>{{ $natureza->descricao }}</option>
                            @foreach ($naturezas as $natureza)
                                <option value="{{ $natureza->id }}">{{ $natureza->descricao }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-7 input-create-box d-flex aligm-items-start justify-content-start flex-column">
                        <span class="tittle-input">Tipo<strong style="color: red">*</strong></span>

                        <select name="tipo_natureza_id" class="select-form w-100" id="select_tipo_natureza" required>
                            <option value="{{ $tipo_natureza->id }}" selected hidden>{{ $tipo_natureza->descricao }}</option>
                            @foreach ($tipo_naturezas as $tipo_natureza)
                                <option value="{{ $tipo_natureza->id }}">{{ $tipo_natureza->descricao }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
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

        console.log(campoanexo.value)

        campoanexo.addEventListener('change', (e) => {

            var string = e.target.value

            var dados = string.split(/[\\"]/g)

            campoArquivo.value = dados[dados.length - 1]
        })

        $('#select_natureza').change(function()
        {
            var natureza = $('#select_natureza').val();

            $.ajax({
                url: '/acao/get/tipo_natureza/' + natureza,
                type: 'GET',
                dataType: 'json',
                success: function (tipo_naturezas)
                {
                    var select = $('#select_tipo_natureza');
                    select.empty();

                    $.each(tipo_naturezas, function(index, item)
                    {
                        select.append($('<option></option>').val(item.id).text(item.descricao));
                    });
                }
            });
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
