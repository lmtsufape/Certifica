<!--View apresentada em gestor -->

@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/acoes/create.css">
    <link rel="stylesheet" href="/css/modelo_certificado/modelo_certificado.css">
    <link rel="stylesheet" href="/css/cadastros/cadastrarAcao.css">
    <link rel="stylesheet" href="/css/modelo_certificado/modal-legendas.css">
@endsection

@section('content')
    <div class="row">

        <div class="container container-form-modelo">
            <h2 class="text-center">Modelo de certificado</h2>

            <!--icone p ativar o modal -->


            <p class="d-flex align-items-center justify-content-center">

                <span class="all-text">
                    Clique
                    <a class="link-modal" data-bs-toggle="modal" data-bs-target="#modal-Legenda">aqui</a>
                    para visualizar as variáveis
                </span>

                <a data-bs-toggle="modal" data-bs-target="#modal-Legenda">
                    <img class="lamp-legendas-icon" src="/images/modal-legenda/lamp.svg" alt="variaveis">
                </a>

            </p>

            <form action="{{ Route('certificado_modelo.edit', ['id' => $modelo->id]) }}" method="GET"
                enctype="multipart/form-data">
                @csrf

                <div class="form-box-modelo-certificado form-row">
                    <input type="hidden" name="unidade_administrativa_id" value="1">

                    <div class="row box col-xl-7">
                        <div class="campo input-create-box d-flex aligm-items-start justify-content-start flex-column">
                            <span class="tittle-input">Descrição</span>
                            <input class="w-75 input-text " type="text" value="{{ $modelo->descricao }}" disabled>
                        </div>
                    </div>

                    <div class="row box d-flex flex-column col-xl-7">
                        <span class="tittle-input w-100">Texto padrão:</span>
                        <textarea name="texto" class="w-100 campo input-create-box text-area-campo" id="texto" disabled>
                        {{ $modelo->texto }}
                    </textarea>
                    </div>

                    <div class="row d-flex align-items-center justify-content-around">

                        <div class="col">
                            <span>Fundo </span>
                            <div class="card-preview-create">
                                <img src="{{ $imagem }}" alt="">
                            </div>
                        </div>
                        <div class="col">
                            <span>Verso </span>
                            <div class="card-preview-create">
                                <img src="{{ $verso }}" alt="">
                            </div>
                        </div>

                    </div>


                    <div class="row d-flex justify-content-start align-items-center mt-4 col-xl-7">

                        <div class="col d-flex justify-content-evenly align-items-center input-create-box border-0">
                            <a class="button d-flex justify-content-center align-items-center cancel"
                                href="{{ route('certificado_modelo.index') }}">Voltar</a>

                            <button class="button submit" type="submit">Editar</button>

                        </div>
                    </div>

                </div>
            </form>
        </div>

        <!--modal legendas -->
        @include('components.modal-Legenda')

    </div>

    <script>
        // correcao text area
        var textarea = document.getElementById("texto")
        textarea.innerHTML = textarea.innerHTML.trim()
    </script>
@endsection
