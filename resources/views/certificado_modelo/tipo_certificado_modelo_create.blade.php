<!--View apresentada em gestor -->

@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/acoes/create.css">
    <link rel="stylesheet" href="/css/modelo_certificado/modelo_certificado.css">
    <link rel="stylesheet" href="/css/cadastros/cadastrarAcao.css">
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center">CRIAR MODELO DE CERTIFICADO</h2>

        <form action="{{ Route('tipo_certificado_modelo.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-box-modelo-certificado form-row">

                <input name="descricao" type="hidden" id="descricao" value="{{ $modelo->descricao }}">
                <input name="fundo" type="hidden" id="imagem" value="{{ $modelo->fundo }}">
                <input name="verso" type="hidden" id="verso" value="{{ $modelo->verso }}">
                <input name="unidade_administrativa_id" type="hidden" id="unidade_administrativa_id"
                    value=" {{ $modelo->unidade_administrativa_id }} ">


                <div class="row box col-xl-7">
                    <div
                        class="campo input-create-box d-flex aligm-items-start justify-content-start flex-column">
                        <span class="tittle-input">Unidade Administrativa</span>
                        <input class="w-75 input-text " type="text" value="{{ $unidade_adm->descricao }}" disabled>
                    </div>
                </div>
                <div class="row box col-xl-7">
                    <div
                        class="campo input-create-box d-flex aligm-items-start justify-content-start flex-column">
                        <span class="tittle-input">Descrição</span>
                        <input class="w-75 input-text " type="text" value="{{ $modelo->descricao }}" disabled>
                    </div>
                </div>

                <div class="row box col-xl-7">
                    <div
                        class="campo spacing-row2 input-create-box d-flex align-items-start justify-content-start flex-column">
                        <span class="tittle-input">Tipo Certificado</span>
                        <select class="select-form w-100 " name="natureza_id" id="select_natureza" required>
                            @foreach ($tipos_certificado as $tipo)
                                <option value="{{ $tipo }}">{{ $tipo }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row box d-flex flex-column col-xl-7">

                    <span class="tittle-input w-100">Texto padrão:</span>


                    <textarea name="texto" class="w-100 campo input-create-box" id="texto">
                        {{ $modelo->texto }}
                    </textarea>
                </div>

                <div class="row d-flex align-items-center justify-content-evenly col-xl-7">

                    <div class="col-5">
                        <span>Fundo: </span>
                        <div class="card-preview">
                            <img src="{{ $img_fundo }}" alt="">

                        </div>
                    </div>
                    <div class="col-5">
                        <span>Verso: </span>
                        <div class="card-preview">

                            <img src="{{ $img_verso }}" alt="">
                        </div>
                    </div>

                </div>


                <div class="row d-flex justify-content-start align-items-center mt-4 col-xl-7">

                    <div class="col d-flex justify-content-evenly align-items-center input-create-box border-0">
                        <a class="d-flex justify-content-center align-items-center cancel"
                            href={{ route('certificado_modelo.index', ['id' => $modelo->id]) }}>Voltar</a>

                        <button class="submit" type="submit">Salvar</button>

                    </div>
                </div>

            </div>
        </form>
    </div>

    <x-legenda/>
@endsection
