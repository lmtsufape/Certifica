<!--View apresentada em adm -->

@extends('layouts.app')


@section('css')
    <link rel="stylesheet" href="/css/acoes/create.css">
    <link rel="stylesheet" href="/css/modelo_certificado/modelo_certificado.css">
@endsection

@section('content')
    <div class="row">
        <div class="container container-form-modelo">
            <h2 class="text-center">CADASTRAR MODELO DE CERTIFICADOS</h2>

            <form class="container form" action="{{ Route('certificado_modelo.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <!--hiddens -->
                <input type="hidden" name="unidade_administrativa_id" value="1">

                <div class="row justify-content-center">

                    <div class="row d-flex aligm-items-start justify-content-start">

                        <div
                            class="col-xl-12 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                            <span class="tittle-input">Título </span>

                            <input class="w-75 input-text" name="descricao" type="text" class="form-control"
                                id="descricao" placeholder="Nome do modelo">
                        </div>
                    </div>


                    <div class="row d-flex flex-column col-xl-12">

                        <span class="tittle-input w-100">Texto padrão:</span>

                        <textarea name="texto" class="w-100 campo input-create-box text-area-campo" id="texto" style="text-align: left">
                       
                         </textarea>
                    </div>

                </div>


                <div class="row d-flex align-items-center justify-content-around">

                    <div class="col text-center">
                        <input hidden type="file" name="verso" id="plano_verso" accept="image/*">

                        <label class="label" for="plano_verso">
                            <span>Verso</span>
                            <div id="card_verso" class="card-preview-create">

                                <img id="img_verso" src="" alt="" width="100%" height="100%">
                                <span id="text_verso">Clique aqui para selecionar o verso do certificado</span>
                            </div>
                        </label>
                    </div>

                    <div class="col text-center">
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


                <div class="row d-flex aligm-items-start justify-content-start">
                    <div
                        class="col-xl-12 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
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
                        <a class="button d-flex justify-content-center align-items-center cancel"
                            href="{{ route('certificado_modelo.index') }}">
                            Voltar
                        </a>
                    </div>

                    <div class="col-2">
                        <button type="submit" class="button submit">Cadastrar</button>
                    </div>

                </div>

            </form>

            <div>
                <x-legenda />
            </div>
        </div>
    </div>

    <script>
        //Preview fundo
        var imgFundo = document.getElementById('img_fundo');
        var planoFundo = document.getElementById('plano_fundo');
        var textFundo = document.getElementById('text_fundo');

        imgFundo.style.display = "none"

        planoFundo.addEventListener('change', (e) => {
            textFundo.style.display = "none"
            imgFundo.style.display = ""

            imgFundo.src = URL.createObjectURL(e.target.files[0])
        })

        //Preview verso

        var imgVerso = document.getElementById('img_verso');
        var planoVerso = document.getElementById('plano_verso');
        var textVerso = document.getElementById('text_verso');

        imgVerso.style.display = "none"

        planoVerso.addEventListener('change', (e) => {
            textVerso.style.display = "none"
            imgVerso.style.display = ""

            imgVerso.src = URL.createObjectURL(e.target.files[0])
        })
    </script>

    <script>
        // correcao text area

        var textarea = document.getElementById("texto")
        textarea.innerHTML = textarea.innerHTML.trim()
    </script>
@endsection
