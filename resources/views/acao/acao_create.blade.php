@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/acoes/create.css">
@endsection

@section('content')
    <h1 class="text-center">Cadastrar ação</h1>
    <form class="container form" action="{{ Route('acao.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Hiddens-->
        <input type="hidden" name="usuario_id" value="{{ Auth::user()->id }}">

        <div class="row d-flex aligm-items-start justify-content-start ">
            <div class="col-md-12 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">Título</span>
                <input class="w-75 input-text " type="text" name="titulo" id="">
            </div>
        </div>

        <div class="row d-flex aligm-items-start justify-content-start">
            <div class="col-md-4 spacing-row2 input-create-box">
                <span class="tittle-input w-50">Data de início</span><input class="w-100" type="date" name="data_inicio"
                    id="">
            </div>
            <div class="col-md-4 spacing-row2 input-create-box">
                <span class="tittle-input w-50">Data de fim</span><input class="w-100" type="date" name="data_fim"
                    id="">
            </div>

            <div
                class="col-md-3 input-create-box input-create-box d-flex aligm-items-start justify-content-start flex-column">
                <span class="tittle-input n-edital">Nº edital</span><input class="w-50 input-text" type="text"
                    name="" id="">
            </div>
        </div>


        <div class="row d-flex aligm-items-start justify-content-start ">

            <input hidden type="file" name="anexo" id="anexo">

            <div class="col-md-8 spacing-row1 input-create-box border-upload d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">Arquivo</span>
                    <div class="w-100 d-flex align-items-center justify-content-between">
                        <input class="w-75 input-text " type="text" name="" id="arquivo" disabled value="" placeholder="Insira aqui o seu arquivo">
                        <label for="anexo" id="">
                            <img class="upload-icon tittle-input" src="/images/acoes/create/upload.svg" alt="">
                        <label for="anexo" id="">
                    </div>
            </div>

            <div class="col-md-3 input-create-box d-flex aligm-items-start justify-content-start flex-column">
                <span class="tittle-input w-25">Natureza</span>
                <select class="select-form w-100 " name="natureza_id" id="">
                    @foreach ($naturezas as $natureza)
                        <option value="{{ $natureza->id }}">{{ $natureza->descricao }}</option>
                    @endforeach
                </select>
            </div>

            <div class="row d-flex aligm-items-start justify-content-start ">
                <div class="col-md-12 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                    <span class="tittle-input ">Unidade Administrativa</span>
                    <select class="select-form w-100 " name="unidade_administrativa_id" id="">
                        @foreach ($unidades_adm as $unidade_adm)
                            <option value="">-- Unidade Administrativa --</option>
                            <option value="{{ $unidade_adm->id }}">{{ $unidade_adm->descricao }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>


        <div class="row d-flex justify-content-start align-items-center">
            <div class="col d-flex justify-content-evenly align-items-center input-create-box border-0">
                <a class="d-flex justify-content-center align-items-center cancel" href={{ route('home') }}>Cancelar</a>
                <button class="submit" type="submit">Cadastrar</button>
            </div>
        </div>

    </form>

    <script>
        var campoanexo = document.getElementById('anexo');
        var campoArquivo = document.getElementById('arquivo')

        campoanexo.addEventListener('change',(e)=>{

           var string = e.target.value

           var dados = string.split(/[\\"]/g)

           campoArquivo.value = dados[dados.length - 1]

        })

    </script>

@endsection








