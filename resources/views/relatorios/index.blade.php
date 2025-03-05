@extends('layouts.app')

@section('title')
    Home
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/list.css">

    <style>
        .loading-message {
            text-align: center;
            font-weight: bold;
            margin: 20px 0;
        }
    </style>
@endsection

@section('content')
    <section class="view-list-acoes">
        <h1 class="text-center mb-4">Relatório</h1>

        <div class="total">
            <strong class='d-flex justify-content-sm-end mb-5' style='font-size: 20px; margin-right: 20px;'>Total de
                certificados: {{ $total }}</strong>
        </div>



        <form id="form" class="container">
            @csrf
            <div>
                <div class="col-1">
                    <a type="button" class="button d-flex align-items-center justify-content-around between"
                        href="{{ route('home') }}">
                        Voltar
                        <img src="/images/acoes/listView/voltar.svg" alt="">
                    </a>
                </div>

                <div class="row head-table search-box d-flex align-items-center justify-content-center">
                    <div class="col-3 d-flex flex-column align-items-start justify-content-center">
                        <span>Nome da Ação</span>
                        <input class="input-box w-75" type="text" name="buscar_acao" id="buscar_acao">
                    </div>

                    <div class="col-3 d-flex flex-column align-items-start justify-content-center">
                        <span>Natureza</span>
                        <select class="input-box w-75" name="natureza" id="natureza">
                            <option></option>
                            @foreach ($naturezas as $natureza)
                                <option value="{{ $natureza->id }}">{{ $natureza->descricao }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-3 d-flex flex-column align-items-start justify-content-center">
                        <span>Tipo Natureza</span>
                        <select class="input-box w-75" name="tipo_natureza" id="tipo_natureza">
                            <option></option>
                            @foreach ($tipos_natureza as $tipo)
                                <option value="{{ $tipo->id }}">{{ $tipo->descricao }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-3 d-flex flex-column align-items-start justify-content-center">
                        <span>Ano</span>
                        <select class="input-box w-75" name="ano" id="ano">
                            <option></option>
                            @foreach ($anos as $ano)
                                <option value="{{ $ano }}">{{ $ano }}</option>
                            @endforeach
                        </select>
                    </div>


                </div>
            </div>
        </form>



        <div class="container">
            <div class="row head-table d-flex align-items-center justify-content-start">
                <div class="col-2 text-center"><span>Ação</span></div>
                <div class="col-2 text-center"><span class="spacing-col">Natureza</span></div>
                <div class="col-2 text-center"><span>Tipo da Natureza</span></div>
                <div class="col-2 text-center"><span>Atividades</span></div>
                <div class="col-1 text-center"><span>Total de Certificados</span></div>
                <div class="col-1 text-center"><span>Certificados</span></div>
                <div class="col-2 text-center"><span>Estatísticas de Certificados</span></div>
            </div>
        </div>

        <div class="list container">
            @include('relatorios.list')
        </div>
    </section>
@endsection


<script src="https://code.jquery.com/jquery-3.7.0.js"></script>


<script>
    /* $(document).ready(function() {
        filtro();
    }); */

    // $(document).bind('keyup', '.form', function(e) {
    //     e.preventDefault();
    //     filtro();

    // });

    $(document).on('change', '#form :input', filtro);

    function filtro() {
        var dados = $('#form').serialize();

        $(".list").html('<p class="loading-message">Carregando...</p>'); // Exibe um indicador de carregamento

        $.get("{{ route('relatorios.filtro') }}", dados)
            .done(function(data) {
                // Insere a resposta no HTML para executar scripts
                $(".list").html(data);

                // Verifica se o total de certificados é zero
                var totalText = $(".total").text().trim();
                if (totalText.includes("Total de certificados: 0")) {
                    $(".list").html('<p class="loading-message">Nenhum resultado encontrado.</p>');
                }
            })
            .fail(function() {
                $(".list").html('<p class="loading-message">Erro ao carregar os dados.</p>');
            });
    }
</script>
