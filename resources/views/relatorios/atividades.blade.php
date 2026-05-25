@extends('layouts.app')

@section('title')
    Home
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/list.css">
@endsection

@section('content')
    <section class="view-list-acoes">

        <h1 class="text-center mb-4">Relatório Ação institucional: {{ $acao->titulo }}</h1>

        <div class="text-center mb-3">
            <h3>Atividades / funções</h3>
        </div>

        <form action="" id="form" class="container">
        @csrf
        <div>
        <div class="d-flex mb-3" style="gap: 12px;">
            <div>
                <a type="button" class="button button-icon-spacing d-flex align-items-center justify-content-around between"
                   href="{{ route('relatorios.index') }}">
                    Voltar
                    <img src="/images/acoes/listView/voltar.svg" alt="">
                </a>
            </div>
            <div>
                <a id="export-atividades" type="button" class="button button-icon-spacing d-flex align-items-center justify-content-around between"
                   href="{{ route('relatorios.export_atividades', ['acao_id' => $acao->id]) }}">
                    Baixar planilha
                    <img class="action-icon" src="/images/acoes/listView/export.svg" alt="">
                </a>
            </div>
        </div>
            <div class="row head-table search-box d-flex align-items-center justify-content-center">
                <div class="col d-flex flex-column align-items-start justify-content-center">
                    <span>Tipo de atividade/função</span>
                    <select class="input-box w-75"  name="descricao" id="descricao">
                        <option value="">Escolher...</option>
                        @foreach ($descricoes as $descricao)
                            <option value="{{ $descricao }}">{{ $descricao }}</option>
                        @endforeach
                        @foreach ($tipoAtividade as $tipo)
                            <option value="{{$tipo->name}}">{{$tipo->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col d-flex flex-column align-items-start justify-content-center">
                    <span>Entre a data</span>
                    <input class="input-box w-75" type="date" name="data" id="data">
                </div>

                <div class="col d-flex flex-column align-items-start justify-content-center">
                    <span>Nome do participante</span>
                    <input class="input-box w-75" type="text" name="buscar_participante" id="buscar_participante">
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
        </div>


        <div class="container">
            <div class="row head-table d-flex align-items-center justify-content-center">
                <div class="col-3  text-center"><span class="spacing-col">Atividade / Função</span></div>
                <div class="col-3  "><span>Período</span></div>
                <div class="col-4 "><span>Integrantes</span></div>
                <div class="col-2 text-center"><span>Total de Certificados</span></div>

            </div>
        </div>

        <div class="list container">
            @foreach($atividades as $atividade)

                <div class="row linha-table d-flex align-items-center justify-content-start">
                    <div class="col-3 text-center titulo-span" title="{{$atividade->descricao}}"><span>{{$atividade->descricao}}</span></div>
                    <div class="col-3">
                        <span>{{ collect(explode('-', $atividade->data_inicio))->reverse()->join('/') .
                            ' - ' .
                            collect(explode('-', $atividade->data_fim))->reverse()->join('/') }}</span>
                    </div>
                    <div class="col-4 titulo-span" title="{{ $atividade->lista_nomes }}">
                        {{ $atividade->nome_participantes }}
                    </div>
                    <div class="col-2 text-center"><span>{{$atividade->total}}</span></div>

                </div>
            @endforeach
        </div>
    </section>
@endsection

@section('javascript')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script>
    $(document).on('change', '#form :input', filtro);

    $(document).ready(function() {
        filtro();
        updateExportLink();

        $('#limpar-filtros').on('click', function() {
            $('#descricao').val('');
            $('#data').val('');
            $('#buscar_participante').val('');
            filtro();
        });
    });

    function filtro() {
        var dados = $('#form').serialize();
        updateExportLink();

        $(".list").html('<p class="loading-message">Carregando...</p>');

        $.get("{{ route('relatorios.atividades_filtro', ['acao_id'=>$acao->id]) }}", dados)
            .done(function(data) {
                $(".list").html(data);
            })
            .fail(function() {
                $(".list").html('<p class="loading-message">Erro ao carregar os dados.</p>');
            });
    }

    function updateExportLink() {
        var dados = $('#form').serialize();
        var baseUrl = "{{ route('relatorios.export_atividades', ['acao_id' => $acao->id]) }}";
        $('#export-atividades').attr('href', dados ? baseUrl + '?' + dados : baseUrl);
    }
</script>
@endsection

