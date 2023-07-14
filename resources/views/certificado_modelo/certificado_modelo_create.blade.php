<!--View apresentada em adm -->

@extends('layouts.app')


@section('css')
    <link rel="stylesheet" href="/css/acoes/create.css">
    <link rel="stylesheet" href="/css/modelo_certificado/modelo_certificado.css">
@endsection

@section('content')
    <h2 class="text-center">CADASTRAR MODELO DE CERTIFICADOS</h2>

    <form class="container form" action="{{ Route('certificado_modelo.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!--hiddens -->
        <input type="hidden" name="unidade_administrativa_id" value="1">

        <div class="row justify-content-center">

            <div class="row d-flex aligm-items-start justify-content-start">
                <div class="col spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                    <span class="tittle-input">Título </span>

                    <input class="w-75 input-text" name="descricao" type="text" class="form-control" id="descricao"
                        placeholder="Nome do modelo">
                </div>
            </div>

            <div class="row d-flex aligm-items-start justify-content-start">
                <div
                    class="col textarea-box spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                    <span class="tittle-input">Texto</span>

                    <textarea class="w-100 input-text textarea-form" name="texto" type="text"
                        placeholder="Texto padrão do certificado ...">
            
                    </textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-1"></div>

            <input hidden type="file" name="verso" id="verso" accept="image/*">

            <div class="col-5 text-center">
                <label class="label" for="verso">
                    <span>Verso</span>
                    <div class="card-preview">
                        <strong><span id="card_verso">nome arquivo</span></strong>
                        <span>(preview em desenvolvimento)</span>
                    </div>
                </label>
            </div>

            <input hidden type="file" name="fundo" id="plano_fundo" accept="image/*">

            <div class="col-5 text-center">
                <label class="label" for="plano_fundo">
                    <span>Plano de fundo</span>
                    <div class="card-preview">
                        <strong><span id="card_plano_fundo">nome arquivo</span></strong>
                        <span>(preview em desenvolvimento)</span>
                    </div>
                </label>
            </div>

            <div class="col-1"></div>
        </div>


        <div class="row d-flex aligm-items-start justify-content-start">
            <div class="col spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input">Unidade Administrativa</span>

                <select class="select-form w-100 " name="unidade_adm" id="unidade_adm" class="form-select">
                    <option value="" selected></option>
                    @foreach ($unidades as $unidade)
                        <option value={{ $unidade->id }}>{{ $unidade->descricao }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mt-5 row align-items-center justify-content-evenly">
            <div class="col-2">
                <a href="{{ route('certificado_modelo.index') }}">
                    <button type="submit" class="voltar">Voltar</button>
                </a>
            </div>

            <div class="col-2">
                <button type="submit" class="cadastrar">Cadastrar</button>
            </div>

        </div>

    </form>

    <!--
        <x-legenda/>
    -->

    <script>
        //nome do arquivo de plano de fundo
        var plano_fundo = document.getElementById('plano_fundo');
        var card_plano_fundo = document.getElementById('card_plano_fundo');

        plano_fundo.addEventListener('change', (e) => {

            var string = e.target.value

            var dados = string.split(/[\\"]/g)

            card_plano_fundo.innerHTML = dados[dados.length - 1]

        })
        //nome do arquivo da verso
        var assinatura = document.getElementById('verso');
        var card_assinatura = document.getElementById('card_verso');

        assinatura.addEventListener('change', (e) => {

            var string = e.target.value

            var dados = string.split(/[\\"]/g)

            card_assinatura.innerHTML = dados[dados.length - 1]

        })
    </script>
@endsection
