@extends('layouts.app')

@section('title')
    Home
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/list.css">
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
                <div class="d-flex flex-wrap align-items-center mb-3" style="gap: 12px;">
                    <div>
                        <a type="button" class="button button-icon-spacing d-flex align-items-center justify-content-around between"
                            href="{{ route('home') }}">
                            Voltar
                            <img src="/images/acoes/listView/voltar.svg" alt="">
                        </a>
                    </div>
                    <div>
                        <a id="export-acoes" type="button" class="button button-icon-spacing d-flex align-items-center justify-content-around between ml-1"
                            href="{{ route('relatorios.export_acoes') }}">
                            Baixar planilha
                            <img class="action-icon" src="/images/acoes/listView/export.svg" alt="">
                        </a>
                    </div>
                </div>

                <div class="row head-table search-box d-flex align-items-center justify-content-center">
                    <div class="col d-flex flex-column align-items-start justify-content-center">
                        <span>Nome da Ação</span>
                        <input class="input-box w-75" type="text" name="buscar_acao" id="buscar_acao">
                    </div>

                    <div class="col d-flex flex-column align-items-start justify-content-center">
                        <span>Natureza</span>
                        <select class="input-box w-75" name="natureza" id="natureza">
                            <option value="">Escolher...</option>
                            @foreach ($naturezas as $natureza)
                                <option value="{{ $natureza->id }}">{{ $natureza->descricao }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col d-flex flex-column align-items-start justify-content-center">
                        <span>Tipo Natureza</span>
                        <select class="input-box w-75" name="tipo_natureza" id="tipo_natureza">
                            <option value="">Escolher...</option>
                            @foreach ($tipos_natureza as $tipo)
                                <option value="{{ $tipo->id }}">{{ $tipo->descricao }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col d-flex flex-column align-items-start justify-content-center">
                        <span>Ano</span>
                        <select class="input-box w-75" name="ano" id="ano">
                            <option value="">Escolher...</option>
                            @foreach ($anos as $ano)
                                <option value="{{ $ano }}">{{ $ano }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col d-flex align-items-center justify-content-center mt-4">
                        <button type="button" id="limpar-filtros" class="button button-icon-spacing d-flex align-items-center justify-content-around between" style="background-color: white; color: #972E3F;">
                            Limpar filtros
                            <img src="/images/acoes/listView/lixoIcon.svg" alt="">
                        </button>
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

@section('javascript')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script>
    $(document).on('change', '#form select', filtro);
    $(document).on('input', '#form input[type="text"]', filtro);
    $(document).on('submit', '#form', function(e) { e.preventDefault(); });

    $(document).ready(function() {
        updateExportLink();

        $('#limpar-filtros').on('click', function() {
            $('#buscar_acao').val('');
            $('#natureza').val('');
            $('#tipo_natureza').val('');
            $('#ano').val('');
            filtro();
        });
    });

    function filtro() {
        var dados = $('#form').serialize();
        updateExportLink();

        $(".list").html('<p class="loading-message">Carregando...</p>'); // Exibe um indicador de carregamento

        $.get("{{ route('relatorios.filtro') }}", dados)
            .done(function(data) {
                // Insere a resposta no HTML para executar scripts
                $(".list").html(data);
            })
            .fail(function() {
                $(".list").html('<p class="loading-message">Erro ao carregar os dados.</p>');
            });
    }

    function updateExportLink() {
        var dados = $('#form').serialize();
        var baseUrl = "{{ route('relatorios.export_acoes') }}";
        $('#export-acoes').attr('href', dados ? baseUrl + '?' + dados : baseUrl);
    }
</script>
@endsection
