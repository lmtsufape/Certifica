<!--View apresentada em adm -->

@extends('layouts.app')


@section('css')
    <link rel="stylesheet" href="/css/acoes/create.css">
    <link rel="stylesheet" href="/css/modelo_certificado/modelo_certificado.css">
    <link rel="stylesheet" href="/css/cadastros/cadastrarAcao.css">
    <link rel="stylesheet" href="/css/modelo_certificado/modal-legendas.css">
@endsection

@section('content')
    <section class="view-create-acao">

        <!--View -->

        <h2 class="text-center">CADASTRAR MODELO DE CERTIFICADOS</h2>

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


        <form class="container form" action="{{ Route('certificado_modelo.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <!--hiddens -->
            <input type="hidden" name="unidade_administrativa_id" value="1">

            <div class="form-row form-box">

                <div class="row box ">

                    <div
                        class="col-xl-12 spacing-row1 campo input-create-box d-flex align-items-start justify-content-start flex-column">
                        <span class="tittle-input">Título </span>

                        <input class="w-100 h-75 input-text" name="descricao" type="text" class="form-control"
                            id="descricao" placeholder="Nome do modelo">
                    </div>
                </div>


                <div class="row box flex-column col-xl-12">

                    <span class="tittle-input w-100">Texto padrão:</span>

                    <textarea name="texto" class="w-100 campo input-create-box" id="texto">
                       
                    </textarea>
                </div>

                <div class="row box">

                    <div class="col-md-6 text-center">
                        <input hidden type="file" name="verso" id="plano_verso" accept="image/*">

                        <label class="label" for="plano_verso">
                            <span>Verso</span>
                            <div id="card_verso" class="card-preview-create">

                                <img id="img_verso" src="" alt="" width="100%" height="100%">
                                <span id="text_verso">Clique aqui para selecionar o verso do certificado</span>
                            </div>
                        </label>

                    </div>

                    <div class="col-md-6 text-center ">
                        <input hidden type="file" name="fundo" id="plano_fundo" accept="image/*">

                        <label class="label" for="plano_fundo">
                            <span>Plano de fundo</span>

                            <div id="card_fundo" class="card-preview-create">

                                <img id="img_fundo" src="" alt="" width="100%" height="100%">
                                <span id="text_fundo">Clique aqui para selecionar o fundo do certificado</span>
                            </div>

                        </label>
                    </div>
                </div>


                <div class="row box mt-3">

                    <div class="col-xl-12 campo spacing-row1 input-create-box">
                        <span class="tittle-input">Unidade Administrativa</span>

                        <select class="select-form w-100 " name="unidade_adm" id="unidade_adm" class="form-select">
                            <option value="" selected></option>

                            @foreach ($unidades as $unidade)
                                <option value={{ $unidade->id }}>{{ $unidade->descricao }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="row d-flex justify-content-start align-items-center">

                    <div class="col d-flex justify-content-evenly align-items-center input-create-box border-0">
                        <a class="button mt-4 d-flex justify-content-center align-items-center cancel"
                            href="{{ route('certificado_modelo.index') }}">Voltar</a>

                        <button class="button submit mt-4" type="submit">Cadastrar</button>
                    </div>
                </div>
                
            </div>

        </form>

        <!--modal legendas -->
        @include('components.modal-Legenda')

    </section>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="/js/modelo_certificado/modelo_certificado-create.js"></script>
    <script src="/js/modelo_certificado/modelo_certificado-geral.js"></script>
@endsection
