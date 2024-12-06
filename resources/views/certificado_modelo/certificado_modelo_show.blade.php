<!--View apresentada em gestor -->

@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/acoes/create.css">
    <link rel="stylesheet" href="/css/modelo_certificado/modelo_certificado.css">
    <link rel="stylesheet" href="/css/cadastros/cadastrarAcao.css">
    <link rel="stylesheet" href="/css/modelo_certificado/modal-legendas.css">
@endsection

@section('content')
    <section class="view-create-acao">

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

        <form class="container form" action="{{ Route('certificado_modelo.edit', ['id' => $modelo->id]) }}" method="GET"
            enctype="multipart/form-data">
            @csrf


            <div class="form-row form-box">

                <input type="hidden" name="unidade_administrativa_id" value="1">

                <div class="row box">
                    <div class="campo col-xl-12 input-create-box d-flex aligm-items-start justify-content-start flex-column">
                        <span class="tittle-input">Descrição</span>
                        <input class="w-100 h-75 input-text " type="text" value="{{ $modelo->descricao }}" disabled>
                    </div>
                </div>

                <div class="row box flex-column col-xl-12">

                    <span class="tittle-input w-100">Texto padrão:</span>
                    <textarea name="texto" class="w-100 campo input-create-box" id="texto" disabled>
                        {{ $modelo->texto }}
                    </textarea>
                </div>



                <div class="row box">

                    <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <span>Fundo </span>

                        <div class="card-preview-create">
                            <img src="{{ $imagem }}" alt="" width="100%" height="100%">
                        </div>

                    </div>

                    <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <span>Verso </span>
                        <div class="card-preview-create">
                            <img src="{{ $verso }}" alt="" width="100%" height="100%">
                        </div>
                    </div>

                </div>


                <div class="row d-flex justify-content-start align-items-center mt-3">

                    <div class="col d-flex justify-content-evenly align-items-center input-create-box border-0">
                        <a class="button d-flex justify-content-center align-items-center cancel"
                            href="{{ route('certificado_modelo.index') }}">Voltar</a>

                        <button class="button submit" type="submit">Editar</button>

                    </div>
                </div>

            </div>
        </form>


        <!--modal legendas -->
        @include('layouts.components.modal-Legenda')

    </section>

    <script src="/js/modelo_certificado/modelo_certificado-geral.js"></script>
@endsection
