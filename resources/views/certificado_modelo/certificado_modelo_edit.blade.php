<!--View apresentada em gestor -->

@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/acoes/create.css">
    <link rel="stylesheet" href="/css/modelo_certificado/modelo_certificado.css">
    <link rel="stylesheet" href="/css/cadastros/cadastrarAcao.css">
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center">ATUALIZAR MODELO DE CERTIFICADO</h2>

        <form action="{{ Route('certificado_modelo.update', ['id' => $modelo->id]) }}" method="POST"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="form-box-modelo-certificado form-row">
                <input type="hidden" name="unidade_administrativa_id" value="1">



                <div class="row box col-xl-7">
                    <div class="campo input-create-box d-flex aligm-items-start justify-content-start flex-column">
                        <span class="tittle-input">Unidade Administrativa</span>

                        <select class="select-form w-100 " name="unidade_adm" id="unidade_adm" class="form-select">
                            <option value="" selected></option>
                            @foreach ($unidades as $unidade)
                                @if ($unidade->id === $modelo->unidade_administrativa_id)
                                    <option value='{{ $unidade->id }}' selected>{{ $unidade->descricao }}</option>
                                @else
                                    <option value='{{ $unidade->id }}'>{{ $unidade->descricao }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row box col-xl-7">
                    <div class="campo input-create-box d-flex aligm-items-start justify-content-start flex-column">
                        <span class="tittle-input">Titulo</span>
                        <input class="w-100 h-100 input-text" name="descricao" type="text" placeholder="Nome do modelo"
                            value="{{ $modelo->descricao }}">
                    </div>
                </div>

                <div class="row box d-flex flex-column col-xl-7">
                    <span class="tittle-input w-100">Texto padrão:</span>

                    <textarea name="texto" class="w-100 campo input-create-box text-area-campo" id="texto">
                        {{ $modelo->texto }}
                    </textarea>
                </div>

                <div class="row d-flex align-items-center justify-content-evenly col-xl-7">

                    <input hidden type="file" name="fundo" id="plano_fundo" accept="image/*"
                        value={{ $modelo->fundo }}>

                    <div class="col-5">
                        <label class="label" for="plano_fundo">
                            <span>Fundo: </span>
                            <div class="card-preview border">
                                <strong>
                                    <span id="card_plano_fundo">nome arquivo</span>
                                </strong>
                                <span>(preview em desenvolvimento)</span>
                            </div>
                        </label>
                    </div>

                    <input hidden type="file" name="verso" id="verso" accept="image/*" value={{ $modelo->verso }}>

                    <div class="col-5">
                        <label class="label" for="verso">
                            <span>Verso: </span>
                            <div class="card-preview border">
                                <strong><span id="card_verso">nome arquivo</span></strong>
                                <span>(preview em desenvolvimento)</span>
                            </div>
                        </label>
                    </div>

                </div>


                <div class="row d-flex justify-content-start align-items-center mt-4 col-xl-7">

                    <div class="col d-flex justify-content-evenly align-items-center input-create-box border-0">
                        <a class="d-flex justify-content-center align-items-center cancel"
                            href={{ route('certificado_modelo.show', ['id' => $modelo->id]) }}>Voltar</a>
                        <button class="submit" type="submit">Salvar</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
    <x-legenda />

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
