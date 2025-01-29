@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/acoes/create.css">
    <link rel="stylesheet" href="/css/cadastros/cadastrarAcao.css">
@endsection

@section('content')
    <h1 class="text-center">Editar ação</h1>

    <form class="container form" action="{{ route('acao.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

         <!-- Hiddens-->
         <input type="hidden" name="id" value="{{ $acao->id }}">
         <input type="hidden" name="usuario_id" value="{{ Auth::user()->id }}">
         <input type="hidden" name="unidade_administrativa_id" value="{{ Auth::user()->unidade_administrativa_id }}">

        <div class="form-row form-box">

            @if (Auth::user()->perfil_id == 2)

                <div class="row box">

                    <div class="col-xl-3 campo spacing-row2 input-create-box d-flex align-items-start justify-content-start flex-column">
                        <span class="tittle-input">Natureza<span class="ast">*</span></span>
                        <select class="select-form w-100 h-100 " name="natureza_id" id="select_natureza" required>
                            <option value={{$natureza->id}} selected hidden> {{$natureza->descricao}}</option>
                            @foreach ($naturezas as $natureza)
                                <option value="{{ $natureza->id }}">{{ $natureza->descricao }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-xl-8 campo grow input-create-box d-flex aligm-items-start justify-content-start flex-column">
                        <span class="tittle-input">Tipo<span class="ast">*</span></span>

                        <select name="tipo_natureza_id" class="select-form w-100 h-100" id="select_tipo_natureza" required>
                            <option value="{{$tipo_natureza->id}}" selected hidden>{{$tipo_natureza->descricao}}</option>
                        </select>
                    </div>
                </div>

                <div class="row box">
                    <div class="col-xl-12 campo input-create-box d-flex aligm-items-start justify-content-start flex-column">
                        <span class="tittle-input">Título<span class="ast">*</span></span>
                        <input class="w-100 h-100 input-text " type="text" name="titulo" id=""
                            value="{{$acao->titulo}}" required>
                    </div>
                </div>

                <div class="row box">
                    <input hidden type="file" name="anexo" id="anexo" value="{{$acao->anexo}}">

                    <div class="col-xl-3 campo spacing-row2 input-create-box ">
                        <span class="tittle-input">Data de Início<span class="ast">*</span></span><input class="w-100 h-75"
                            type="date" name="data_inicio" id="" value="{{$acao->data_inicio}}" required>
                    </div>

                    <div class="col-xl-3 campo spacing-row2 input-create-box">
                        <span class="tittle-input">Data de Término <span class="ast">*</span></span>
                        <input class="w-100 h-75" type="date" name="data_fim" id="" value="{{$acao->data_fim}}"
                            required>
                    </div>


                    <div class="col-xl-5 grow campo input-create-box d-flex align-items-start justify-content-start flex-column">
                        <span class="tittle-input">Processo SIPAC, relatório final ou similares<span
                                class="ast">*</span></span>

                        <div class="w-100 d-flex align-items-center justify-content-between">
                            <input class="w-75 grow h-100 input-text " type="text" name="" id="arquivo" disabled
                                value="" placeholder="@if($nomeAnexo) {{$nomeAnexo}} @else Insira aqui o seu arquivo @endif" required>
                            <label for="anexo" id="">
                                <img class="upload-icon tittle-input" src="/images/acoes/create/upload.svg" alt="">
                                <label for="anexo" id=""> </label>
                            </label>
                        </div>
                    </div>

                </div>
            @else

                <div class="row box">
                    <div class="col-xl-12 campo input-create-box d-flex aligm-items-start justify-content-start flex-column">
                        <span class="tittle-input">Título<span class="ast">*</span></span>
                        <input class="w-100 h-100 input-text " type="text" name="titulo" id=""
                            value="{{$acao->titulo}}" required>
                    </div>
                </div>

                <div class="row box">
                    <div class="col-xl-3 campo spacing-row2 input-create-box ">
                        <span class="tittle-input"> Data de Início<span class="ast">*</span> </span>
                        <input class="w-100 h-75" type="date" name="data_inicio" id=""
                            value="{{$acao->data_inicio}}" required>
                    </div>

                    <div class="col-xl-3 campo spacing-row2 input-create-box">
                        <span class="tittle-input">Data de Término<span class="ast">*</span></span>
                        <input class="w-100 h-75" type="date" name="data_fim" id="" value="{{$acao->data_fim}}" required>
                    </div>

                    <input type="hidden" name="natureza_id" value="{{ $natureza->id }}">

                    <div class="col-xl-5 campo input-create-box grow">
                        <span class="tittle-input">Tipo<span class="ast">*</span></span>

                        <select name="tipo_natureza_id" class="select-form w-100 h-75" id="select_tipo_natureza" required>
                            <option value="{{$tipo_natureza->id}}" selected hidden>{{$tipo_natureza->descricao}}</option>
                            @foreach ($tipo_naturezas as $tipo_natureza)
                                <option value="{{ $tipo_natureza->id }}">{{ $tipo_natureza->descricao }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif

            @if($acao->data_personalizada)
                <div class="row box col-xl-7">
                    <div class="d-flex align-items-center">
                        <label class="form-check-label me-2 mb-0" for="toggleDataPersonalizada" style="display: flex; align-items: center; margin-bottom: 0; margin-left: 0;">
                            Ativar data personalizada?
                        </label>
                        <input class="form-check-input" type="checkbox" id="toggleDataPersonalizada" style="margin-top: 0; margin-left: 5px;" checked>
                    </div>
                </div>

                <br>

                <div class="row box flex-column col-xl-12" id="dataPersonalizadaContainer">
                    <div class="col-xl-3 campo spacing-row2 input-create-box ">
                        <span class="tittle-input">Data Personalizada</span>
                        <input class="w-100 h-75" type="date" name="data_personalizada" id="inputDataPersonalizada"
                               value="{{ $acao->data_personalizada }}">
                    </div>
                </div>
            @else
                <div class="row box col-xl-7">
                    <div class="d-flex align-items-center">
                        <label class="form-check-label me-2 mb-0" for="toggleDataPersonalizada" style="display: flex; align-items: center; margin-bottom: 0; margin-left: 0;">
                            Ativar data personalizada?
                        </label>
                        <input class="form-check-input" type="checkbox" id="toggleDataPersonalizada" style="margin-top: 0; margin-left: 5px;">
                    </div>
                </div>

                <br>

                <div class="row box flex-column col-xl-12 d-none" id="dataPersonalizadaContainer">
                    <div class="col-xl-3 campo spacing-row2 input-create-box ">
                        <span class="tittle-input">Data Personalizada</span>
                        <input class="w-100 h-75" type="date" name="data_personalizada" id="inputDataPersonalizada"
                               value="{{ old('data_personalizada') }}">
                    </div>
                </div>
            @endif

            <div class="row d-flex justify-content-start align-items-center">
                <div class="col d-flex justify-content-evenly align-items-center input-create-box border-0">
                    <a class="button d-flex justify-content-center align-items-center cancel"
                        href="javascript:history.back()">Voltar</a>
                    <button class="button submit" type="submit">Salvar</button>
                </div>
            </div>
        </div>
    </form>

    <script src="/js/acao/acao-edit-create.js"></script>

    <script>
        document.getElementById('toggleDataPersonalizada').addEventListener('change', function() {
            var dataPersonalizadaContainer = document.getElementById('dataPersonalizadaContainer');
            var inputDataPersonalizada = document.getElementById('inputDataPersonalizada');

            if (this.checked) {
                dataPersonalizadaContainer.classList.remove('d-none');
            } else {
                dataPersonalizadaContainer.classList.add('d-none');

                if (inputDataPersonalizada) {
                    inputDataPersonalizada.value = null;
                }
            }
        });
    </script>
@endsection
