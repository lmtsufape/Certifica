@extends('layouts.app')


@section('css')
    <link rel="stylesheet" href="/css/acoes/create.css">
    <link rel="stylesheet" href="/css/modelo_certificado/modelo_certificado.css">
@endsection

@section('content')
    <h2 class="text-center">ATUALIZAR MODELO DE CERTIFICADO</h2>

    <form class="container form" action="{{ Route('certificado_modelo.update', ['id' => $modelo->id]) }}" method="POST"
        enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <!--hiddens -->

        <input type="hidden" name="unidade_administrativa_id" value="1">

        <div class="row justify-content-center">

            <div class="row d-flex aligm-items-start justify-content-start">
                <div class="col spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                    <span class="tittle-input">Título </span>

                    <input class="w-75 input-text" name="descricao" type="text" class="form-control" id="descricao"
                        placeholder="Nome do modelo" value="{{ $modelo->descricao }}">
                </div>
            </div>

            <div class="row d-flex aligm-items-start justify-content-start">
                <div
                    class="col textarea-box spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                    <span class="tittle-input">Texto</span>

                    <textarea class="w-100 input-text textarea-form" name="texto" type="text"
                        placeholder="Texto padrão do certificado ...">
                        {{ $modelo->texto }}
                    </textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-1"></div>

            <input hidden type="file" name="verso" id="verso" accept="image/*" value={{$modelo->verso}}>

            <div class="col-5 text-center">
                <label class="label" for="verso">
                    <span>Verso</span>
                    <div class="card-preview">
                        <strong><span id="card_verso">nome arquivo</span></strong>
                        <span>(preview em desenvolvimento)</span>
                    </div>
                </label>
            </div>

            <input hidden type="file" name="fundo" id="plano_fundo" accept="image/*" value={{$modelo->fundo}}>

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
                        @if ($unidade->id === $modelo->unidade_administrativa_id)
                            <option value='{{ $unidade->id }}' selected>{{ $unidade->descricao }}</option>
                        @else
                            <option value='{{ $unidade->id }}'>{{ $unidade->descricao }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mt-5 row align-items-center justify-content-evenly">
            <div class="col-2">
                <a href="{{route('certificado_modelo.show',['id'=>$modelo->id])}}">
                    <button type="submit" class="voltar">Voltar</button>
                </a>
            </div>

            <div class="col-2">
                <button type="submit" class="cadastrar">Salvar</button>
            </div>

        </div>

    </form>

    <x-legenda/>

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



<!--
<div class="container">
    <div class='row justify-content-center'>
        <div class='col-12' style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
            <h2>ATUALIZAR MODELO DE CERTIFICADO</h2>
        </div>
    </div>

    <form action="{{ Route('certificado_modelo.update', ['id' => $modelo->id]) }}" method="POST" enctype="multipart/form-data" >
        @method('PUT')
        @csrf
        <input type="hidden" name="unidade_administrativa_id" value="1">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="row">

                    <div class="form-group">
                        <label for="nome">Descrição</label>
                        <input name="descricao" type="text" class="form-control" id="descricao" value="{{ $modelo->descricao }}">
                    </div>

                    <div class="form-group">
                        <label for="frente_certificado">Frente do Certificado</label>
                        <input name="fundo" type="file" class="form-control" id="fundo" accept="image/*" value='<?= $modelo->fundo ?>'>
                    </div>
                    <div class="col-3" style='margin-top: 5px;'>
                        <a href="{{ route('certificado_modelo.show_img', ['id' => $modelo->id, 'imagem' => 'fundo']) }}"  class='btn btn-sm btn-outline-secondary' target="_blank">Ver imagem</a>
                    </div>

                    <div class="form-group">
                        <label for="verso_certificado">Verso do Certificado</label>
                        <input name="verso" type="file" class="form-control" id="verso" accept="image/*" value='<?= $modelo->verso ?>'>
                    </div>
                    <div class="col-3" style='margin-top: 5px;'>
                        <a href="{{ route('certificado_modelo.show_img', ['id' => $modelo->id, 'imagem' => 'verso']) }}"  class='btn btn-sm btn-outline-secondary' target="_blank">Ver imagem</a>
                    </div>

                    <div class="form-group">
                        <label for="texto">Texto padrão:</label>
                        <textarea name="texto" type="text" class="form-control" id="texto" rows='5'>{{ $modelo->texto }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="unidade_adm">Unidade Administrativa</label>
                        <select name="unidade_adm" id="unidade_adm" class="form-select">
                            <option value='' selected></option>
                            @foreach ($unidades as $unidade)
@if ($unidade->id === $modelo->unidade_administrativa_id)
<option value='{{ $unidade->id }}' selected>{{ $unidade->descricao }}</option>
@else
<option value='{{ $unidade->id }}'>{{ $unidade->descricao }}</option>
@endif
@endforeach
                        </select>
                    </div>
                    <div class="row justify-content-end" style='margin-top: 5px;'>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                        <div class="col-2">
                            <a href="{{ route('certificado_modelo.show', ['id' => $modelo->id]) }}" class='btn btn-primary' style='margin-left: 10px'>Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
-->
