@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/acoes/create.css">
    <link rel="stylesheet" href="/css/cadastros/cadastrarAcao.css">
@endsection

@section('content')
    <section class="view-create-acao">

        <h1 class="text-center">Cadastrar Ação</h1>

        <form class="container form" action="{{ Route('acao.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Hiddens-->
            <input type="hidden" name="usuario_id" value="{{ Auth::user()->id }}">

            <div class="form-row form-box">



                @if (Auth::user()->perfil_id == 2)
                    <div class="row box">

                        <div
                            class="col-xl-3 campo spacing-row2 input-create-box d-flex align-items-start justify-content-start flex-column">
                            <span class="tittle-input">Natureza<span class="ast">*</span></span>
                            <select class="select-form w-100 h-100" name="natureza_id" id="select_natureza" required>
                                <option value="" selected hidden>-- Natureza --</option>
                                @foreach ($naturezas as $natureza)
                                    <option value="{{ $natureza->id }}">{{ $natureza->descricao }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div
                            class="col-xl-8 campo grow input-create-box d-flex aligm-items-start justify-content-start flex-column">
                            <span class="tittle-input">Tipo<span class="ast">*</span></span>

                            <select name="tipo_natureza_id" class="select-form w-100 h-100" id="select_tipo_natureza"
                                required>
                                <option value="" selected hidden>-- Tipo Natureza --</option>
                            </select>
                        </div>
                    </div>

                    <div class="row box">
                        <div
                            class="col-xl-12 campo input-create-box d-flex aligm-items-start justify-content-start flex-column">
                            <span class="tittle-input">Título<span class="ast">*</span></span>
                            <input class="w-100 h-100 input-text " type="text" name="titulo" id="" required>
                        </div>
                    </div>

                    <div class="row box">
                        <input hidden type="file" name="anexo" id="anexo">

                        <div class="col-xl-3 campo spacing-row2 input-create-box ">
                            <span class="tittle-input">Data de Início<span class="ast">*</span></span>
                            <input class="w-100 h-75" type="date" name="data_inicio" id=""
                                value="{{ old('data_inicio') }}" required>
                        </div>

                        <div class="col-xl-3 campo spacing-row2 input-create-box">
                            <span class="tittle-input">Data de Término <span class="ast">*</span></span>
                            <input class="w-100 h-75" type="date" name="data_fim" id=""
                                value="{{ old('data_fim') }}" required>
                        </div>

                        <div
                            class="col-md-5 campo grow input-create-box d-flex align-items-start justify-content-start flex-column">
                            <span class="tittle-input">Processo SIPAC, relatório final ou similares<span
                                    class="ast">*</span></span>

                            <div class="w-100 d-flex align-items-center justify-content-center">
                                <input class="grow input-text h-100" type="text" name="" id="arquivo" disabled
                                    value="" placeholder="Insira aqui o seu arquivo" required>

                                <label for="anexo" id="" class="h-100">
                                    <img class="upload-icon tittle-input" src="/images/acoes/create/upload.svg" alt="">
                                    <label for="anexo" id=""> </label>
                                </label>

                            </div>
                        </div>
                    </div>
                @else
                    <div class="row box">
                        <div
                            class="col-xl-12 campo input-create-box d-flex aligm-items-start justify-content-start flex-column">
                            <span class="tittle-input">Título<span class="ast">*</span></span>
                            <input class="w-100 h-100 input-text " type="text" name="titulo" id=""
                                value="{{ old('titulo') }}" required>
                        </div>
                    </div>

                    <div class="row box">
                        <div class="col-xl-3 campo spacing-row2 input-create-box ">
                            <span class="tittle-input"> Data de Início<span class="ast">*</span> </span>
                            <input class="w-100 h-75" type="date" name="data_inicio" id=""
                                value="{{ old('data_inicio') }}" required>
                        </div>

                        <div class="col-xl-3 campo spacing-row2 input-create-box">
                            <span class="tittle-input">Data de Término<span class="ast">*</span></span><input
                                class="w-100 h-75" type="date" name="data_fim" id=""
                                value="{{ old('data_fim') }}" required>
                        </div>

                        <input type="hidden" name="natureza_id" value="{{ $natureza->id }}">

                        <div class="col-xl-5 campo input-create-box grow">
                            <span class="tittle-input">Tipo<span class="ast">*</span></span>

                            <select name="tipo_natureza_id" class="select-form w-100 h-75 " id="select_tipo_natureza"
                                required>
                                <option value="" selected hidden>-- Tipo Natureza --</option>
                                @foreach ($tipo_naturezas as $tipo_natureza)
                                    <option value="{{ $tipo_natureza->id }}">{{ $tipo_natureza->descricao }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif

                <div class="row d-flex justify-content-start align-items-center">
                    <div class="col d-flex justify-content-evenly align-items-center input-create-box border-0">
                        <a class="d-flex justify-content-center align-items-center cancel"
                            href={{ route('acao.index') }}>Cancelar</a>
                        <button class="submit" type="submit">Cadastrar</button>
                    </div>
                </div>
            </div>
        </form>

    </section>














    <script>
        var campoanexo = document.getElementById('anexo');
        var campoArquivo = document.getElementById('arquivo');

        campoanexo.addEventListener('change', (e) => {

            var string = e.target.value

            var dados = string.split(/[\\"]/g)

            campoArquivo.value = dados[dados.length - 1]

        })

        $('#select_natureza').change(function() {
            var natureza = $('#select_natureza').val();

            $.ajax({
                url: '/acao/get/tipo_natureza/' + natureza,
                type: 'GET',
                dataType: 'json',
                success: function(tipo_naturezas) {
                    var select = $('#select_tipo_natureza');
                    select.empty();

                    $.each(tipo_naturezas, function(index, item) {
                        select.append($('<option></option>').val(item.id).text(item.descricao));
                    });
                }
            });
        });
    </script>
@endsection
